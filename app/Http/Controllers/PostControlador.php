<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostControlador extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('welcome', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = $request->file('arquivo')->store('imagens', 'public');

        $post = new Post();
        $post->email = $request->get('email');
        $post->mensagem = $request->get('mensagem');
        $post->arquivo = $path;
        if ($post->save()) {
            return redirect("/");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function download(string $id)
    {
        $post = Post::find($id);
        if (isset($post)) {
            $arquivo = Storage::disk('public')->path($post->arquivo);
            return response()->download($arquivo);
        }

        return redirect("/");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $post = Post::find($id);
            Storage::disk('public')->delete($post->arquivo);
            Post::destroy($id);
        } catch (Exception $e) {
            die("ERRO: " . $e->getMessage());
        }

        return redirect("/");
    }
}