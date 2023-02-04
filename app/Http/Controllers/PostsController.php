<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $postModel)
    {
        $posts = $postModel->getPosts();
        return view('posts/index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $postModel)
    {
        // dd($request->input());

        $validated  = $request->validate([
            'tipo_post' => 'required',
            'titulo_post' => 'required',
            'foto_post' => 'required',
            'fotos_post'  => 'required',
            'texto_post' => 'required'
        ]);
        
        $ip = $request->input('ip');
        $titulo = $request->input('titulo_post');
        $sub_titulo = $request->input('sub_titulo_post');
        $descr = $request->input('descr');
        $foto = $request->input('foto_post');
        $foto2 = $request->input('foto2');
        $legenda = $request->input('legenda');
        $texto = $request->input('texto');
        $video = $request->input('video');
        $por = $request->input('por');
        $tipo = $request->input('tipo');
        $link = $request->input('link');
        $destaque = $request->input('destaque');
        $status = $request->input('status_post');
        
        $data = $request->input('data');
      
     

        $postModel->savePost($ip,$titulo,$sub_titulo,$descr,$foto,$foto2,$legenda,$texto,$video,$por,$tipo,$link,$destaque,$status);

      return view('posts/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
