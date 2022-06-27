<?php

namespace App\Http\Controllers\Api;

use App\Models\Enum\Status;
use Exception;
use App\Models\Image;
use App\Models\Maquina;
use App\Models\Container;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ContainersController extends Controller
{
    private $url;

    public function __construct()
    {
        $this->url = env('DOCKER_HOST');
    }

    public function toggleContainer($container_id)
    {
        $instancia = Container::findOrFail($container_id);
        $docker_id = $instancia->docker_id;

        if ($instancia->isRunning()) {
            $host = $this->url."/containers/$docker_id/stop";
            $status = Status::PAUSED;
        } else {
            $host = $this->url."/containers/$docker_id/start";
            $status = Status::RUNNING;
        }

        $response = Http::post($host);

        $instancia->status = $status;
        $instancia->data_hora_finalizado = $status == Status::PAUSED ? now() : null;

        $instancia->save();

        return redirect()
            ->back()
            ->with('success', 'Container toggled successfully!');
    }

    public function index()
    {
        return view(
            'pages.containers.index',
            ['containers' => Auth::user()->containers()->paginate(10),
            'dockerHost' => env('DOCKER_HOST')]
        );
    }

    public function terminalNewTab($id)
    {
        $container = Container::firstWhere('docker_id', $id);

        $params = [
            'mycontainer' => $container,
            'socketParams' => json_encode([
                'dockerHost' => env('DOCKER_HOST_WS'),
                'container_id' => $id,
            ]),
        ];

        return view('pages/my-containers/my_containers_terminal_tab', $params);
    }

    public function show($id)
    {
        $processes = Http::get($this->url."/containers/$id/top");
        $details = Http::get($this->url."/containers/$id/json");

        $params = [
            'mycontainer' => Container::findOrFail($id),
            'processes' => ($processes->getStatusCode() == 200 ? $processes->json() : null),
            'details' => $details->getStatusCode() == 200 ? $details->json() : null,
        ];

        return view('pages.containers.view', $params);
    }

    public function store(Request $request)
    {
        try {
            $data = $this->setDefaultDockerParams($request->all());
            $url = $this->url;

            $this->pullImage($url, Image::findOrFail($request['image_id']));
            $this->createContainer($url, $data);

            return redirect()->route('containers.index')->with('success', 'Container creation is running!');
        } catch (Exception $e) {
            return  $e->getMessage();
        }
    }

    public function edit($id)
    {
        return view('pages.containers.edit', ['container' => Container::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        if ($request->nickname) {
            $instancia = Container::firstWhere('docker_id', $id);
            $instancia->update($request->all());

            return redirect()
                ->route('containers.index')
                ->with('success', 'Container updated!!!');
        } else {
            return redirect()
                ->route('containers.index')
                ->with('error', "Nickname can't be blank!!!");
        }
    }

    public function destroy($id)
    {
        $container = Container::findOrFail($id);
        $docker_id = $container->docker_id;
        $responseStop = Http::post($this->url."/containers/$docker_id/stop")->getStatusCode();


        if ($responseStop == 204 || $responseStop == 304) {
            $responseDelete = Http::delete($this->url."/containers/$docker_id")->getStatusCode();
            if ($responseDelete == 204) {
                $container->delete();

                return redirect()
                    ->route('containers.index')
                    ->with('success', 'Container deleted with successfully!');
            } else {
                return redirect()
                    ->route('containers.index')
                    ->with('error', 'Fail, container not deleted!'.$responseDelete);
            }
        } else {
            return redirect()
                ->route('instance.index')
                ->with('error', 'Fail, container not deleted!'.$responseStop);
        }
    }

    private function pullImage($url, Image $image)
    {
        $uri = "images/create?fromImage=$image->from_image&tag=$image->tag";
        $image->from_src ? $uri .= "&fromSrc=$image->from_src" : $uri;
        $image->repo ? $uri .= "&repo=$image->repo" : $uri;
        $image->message ? $uri .= "&message=$image->message" : $uri;

        $response = Http::post("$url/$uri");

        if ($response->getStatusCode() != 200) {
            dd($response->json());
        }
    }

    private function createContainer($url, $data)
    {
        $data['user_id'] = Auth::id();

        $response = Http::asJson()->post("$url/containers/create", $data);

        if ($response->getStatusCode() == 201) {
            $container_id = $response->json()['Id'];
            $response = Http::asJson()->post("$url/containers/$container_id/start");

            $data['hashcode_maquina'] = Maquina::first()->hashcode;
            $data['docker_id'] = $container_id;
            $data['data_hora_instanciado'] = now();
            $data['data_hora_finalizado'] = $response->getStatusCode() == 204 ? null : now();

            $container = Container::create($data);
            $container->status = Status::RUNNING;
            $container->save();
        } else {
            dd($response->json());
        }
    }

    private function setDefaultDockerParams(array $data)
    {
        $data['image'] = Image::findOrFail($data['image_id'])->from_image;
        $data['memory'] = $data['memory'] ? intval($data['memory']) : 0;

        $data['env'] = $data['env_variables'] ? explode(';', trim($data['env_variables'])) : [];

        $data['AttachStdin'] = true;
        $data['AttachStdout'] = true;
        $data['AttachStderr'] = true;
        $data['OpenStdin'] = true;
        $data['StdinOnce'] = false;
        $data['Tty'] = true;

        $data['Entrypoint'] = [
            '/bin/bash',
        ];

        $data['HostConfig'] = [
            'PublishAllPorts' => true,
            'Privileged' => true,
            'RestartPolicy' => [
                'name' => 'always',
            ],
            'Binds' => [
                '/var/run/docker.sock:/var/run/docker.sock',
                '/tmp:/tmp',
            ],
        ];

        return $data;
    }
}
