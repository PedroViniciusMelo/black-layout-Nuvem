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
        return view('pages.images.create');
    }

    public function store(Request $request)
    {
        $this->validar($request);

        if (Auth::user()->isAdmin()) {
            Image::create($request->all());

            return redirect()->route('images.index')->with('success', 'Container created!!!');
        } else {
            return redirect()->route('images.index')->with('error', 'User do not have permission for this!!!');
        }
    }

    public function edit($id)
    {
        return view('pages.images.create', ['image' => Image::findOrFail($id)]);
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
        $container = Image::findOrFail($id);

        $container->delete();

        return redirect()
            ->back()
            ->with('success', 'Container deleted!!!');
    }

    public function configureContainer($image_id)
    {
        return view('pages.images.containers_config', ['image' => Image::findOrFail($image_id)]);
    }

    private function validar(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'description' => ['required'],
            'from_image' => ['required'],
            'tag' => ['required'],
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
        $imagem->from_image = $pieces[0];
        $imagem->tag = $pieces[1];
        $imagem->save();

        return redirect()->back();
    }
}
