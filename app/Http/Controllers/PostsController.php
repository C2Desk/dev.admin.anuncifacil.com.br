<?php

namespace App\Http\Controllers;

use App\Entities\posts\PostEntitie;
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
    public function store(Request $request, Post $postModel, PostEntitie $post)
    {
        // dd($request->input());

        $validated  = $request->validate([
            'tipo_post' => 'required',
            'titulo_post' => 'required',
            'foto_post' => 'required',
            // 'fotos_post'  => 'required',
            'status_post' => 'required',
            'texto_post' => 'required'
        ]);

        $post->setIp((int) $request->input('ip'));
        $post->setTitulo($request->input('titulo_post'));
        $post->setSubTitulo($request->input('sub_titulo_post'));
        // $post->setDescr($request->input('texto_post'));
        $post->setFoto($request->input('foto_post'));
        if($request->input('foto2') !== null || !empty($request->input('foto2')))
            $post->setFoto2($request->input('foto2'));
        if($request->input('legenda') !== null || !empty($request->input('legenda')))    
        $post->setLegenda($request->input('legenda'));
        $post->setTexto($request->input('texto_post'));
        // $post->setVideo($request->input('video'));
        // $post->setPor($request->input('por'));
        $post->setTipo($request->input('tipo_post'));
        if($request->input('link') !== null || !empty($request->input('link')))
            $post->setLink($request->input('link'));
        if($request->input('destaque') !== null || !empty($request->input('destaque')))
            $post->setDestaque($request->input('destaque'));
        $post->setStatus($request->input('status_post'));

        $post->setData(date("Y-m-d"));
    
        $postModel->savePost($post);

      return redirect()->back();
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
    public function edit(Post $postEntitie, $postId)
    {
        $post = null;
        
        if($postId !== null && is_numeric($postId))
        {
            $post = $postEntitie->getPostById($postId);
            //@TODO - verificar se o post exist, caso exista redirecionar para tela de edição se não retorna para a listagem de posts com mensagem de erro.
        } 

        return view("posts/edit", [
            'post' => $post
        ]);
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
        dd($request->input());
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
