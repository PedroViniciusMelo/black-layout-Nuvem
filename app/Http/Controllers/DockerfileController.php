<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\Dockerfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DockerfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dockerfiles = Dockerfile::all();
        $url = env('DOCKER_HOST');

        return view('pages.dockerfile.index', ['dockerfiles' => $dockerfiles, 'url' => $url]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dockerfile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dockerfiles = Dockerfile::all();
        $path = storage_path('app/public/'.$request->tag);
        $nameFile = 'Dockerfile.tar.gz';
        if($request->file('file')->isValid()){
            $path = $request->file('file')->storeAs(
                $request->tag, 'Dockerfile.tar.gz'
            );
            Dockerfile::create([
                'file' => $path,
                'tag'  => $request->tag
            ]);
        }
        // $files = Storage::files($request->tag);
        // dd($files[0]);
        // $url = Storage::url($path);
        // dd($url);


        return redirect()->route('dockerfiles.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function build(Request $request)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => env('DOCKER_HOST'),
            // You can set any number of default request options.
            'timeout'  => 2000.0,
        ]);

        $dockerfile = Dockerfile::where('tag', $request->tag)->first();
        $path = storage_path('app/public/'.$dockerfile->tag.'/Dockerfile.tar.gz');
        // dd($path);


        $url = env('DOCKER_HOST');
        $body = fopen($path, 'r');
        $r = $client->request('POST', $url.'/build?t='.$dockerfile->tag,
            ['body' => $body,
             'Content-type' => 'application/x-tar'
            ]);



        return redirect()->back();
    }
}
