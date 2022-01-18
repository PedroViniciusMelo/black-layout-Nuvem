<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImagesController extends Controller
{
    public function index()
    {
        $data = [
            'images' => Image::paginate(10),
            'isAdmin' => Auth::user()->isAdmin(),
            'user_id' => Auth::user()->id,
            'title' => 'Images',
        ];

        return view('pages.images.index', $data);
    }

    public function create()
    {
        return view('pages/images/images_new');
    }

    public function store(Request $request)
    {
        $this->validar($request);

        if (Auth::user()->isAdmin()) {
            Image::create($request->all());

            return redirect()->route('images.index')->with('success', 'Container created!!!');
        } else {
            return redirect()->route('images.index')->with('error', 'User not have permition for this!!!');
        }
    }

    public function edit($id)
    {
        return view('pages/images/images_edit', ['image' => Image::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {
        $this->validar($request);
        if (Auth::user()->isAdmin()) {
            $container = Image::findOrFail($id);
            $container->update($request->all());
        }

        return redirect()
            ->back()
            ->with('success', 'Container updated!!!');
    }

    public function destroy($id)
    {
        $container = Image::findOrFail('id', $id);

        $container->delete();

        return redirect()
            ->back()
            ->with('success', 'Container deleted!!!');
    }

    public function configureContainer(Request $request)
    {
        $params = [
            'image' => Image::firstWhere('id', $request->image_id),
            'user' => Auth::user()->name,
            'user_id' => Auth::user()->id,
        ];

        return view('pages.images.containers_config', $params);
    }

    private function validar(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required '],
            'fromImage' => ['required '],
            'tag' => ['required '],
        ]);
    }



    public function salvarImagem(Request $request)
    {
        $pizza  = $request->repoTags;
        $pieces = explode(":", $pizza);
        //dd($pieces[0]);
        $imagem = new Image();
        $imagem->name = $pieces[0];
        $imagem->description = "Imagem criada de um Dockerfile";
        $imagem->fromImage = $pieces[0];
        $imagem->tag = $pieces[1];
        $imagem->created_at = now();
        $imagem->updated_at = now();
        $imagem->save();

        return redirect()->back();
    }
}
