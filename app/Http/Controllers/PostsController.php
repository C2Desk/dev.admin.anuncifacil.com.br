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

    //Idex: chamar tela index

    public function index(Post $postModel)
    {
        return view('posts/index');
    }

    //Paginação: chamar a lista de postagens na tela

    public function paginacao()
    {
        $posts = Post::when(request('nome') != null, function ($query) {
            return $query->where('titulo', 'like', '%' . request('nome') . '%');
        })->orderBy('id', 'DESC')->paginate(10);
        return view('posts.list')->with('posts', $posts);
    }

    //Search: Função de pesquisa dento de postagens na tela de paginação
/*
    public function search(Request $request, Post $postModel)
    {
        $search = $request->input('search');
        $posts = Post::orderBy('id', 'DESC')->where('titulo', 'LIKE', '%' .  $search  . '%')->paginate(10);
        return view('posts/index', [
            'posts' => $posts
        ]);
    }
*/
    //Create: mandar para a pagina de criação de nova postagem.

    public function create()
    {
        return view('posts/create');
    }
    //Create: mandar para a pagina de criação de nova postagem SOCIAL.

    public function social()
    {
        return view('posts/social');
    }


    //Store: manda as informações do formulario pra model de postagem.

    public function store(Request $request, Post $postModel)
    {
        $mensagens = [

            //Tipo

            'tipo_post.required' => 'Selecione um tipo',

            //titulo

            'titulo_post.required' => 'O campo titulo é obrigatório',
            'titulo_post.min' => 'O titulo deve ter pelo menos 5 caracteres.',

            //texto

            'texto_post.required' => 'O campo texto é obrigatório',
            'texto_post.min' => 'O campo texto deve ter pelo menos 5 caracteres.',
        ];
        $request->validate([
            'tipo_post' => 'required|nullable',
            'titulo_post' => 'required|nullable|min:5',
            'texto_post' => 'required|nullable|min:5',
        ], $mensagens);

        $ip = $request->input('ip'); // Revisar #automatico
        $tipo = $request->input('tipo_post');
        $titulo = $request->input('titulo_post');
        $legenda = $request->input('legenda_post');
        $video = $request->input('video_post');
        $sub_titulo = $request->input('sub_titulo_post'); //Não usa no banco
        $descr = $request->input('descr_post');
        //$foto = $request->input('foto1_post');
        $foto2 = $request->input('foto2_post');
        $status = $request->input('status_post');
        $texto = $request->input('texto_post');
        $destaque = $request->input('destaque'); //Pouco usado revisar necessidade

        $por = $request->input('por'); // Revisar #automatico usuario logado
        $link = $request->input('link'); //Pouco usado revisar necessidade
        $data = $request->input('data');
        $foto = $request->foto1_post->store('public/post');

        $postModel->savePost($ip, $titulo, $sub_titulo, $descr, $foto, $foto2, $legenda, $texto, $video, $por, $tipo, $link, $destaque, $status);
        return redirect('posts');
    }

    public function show(Post $post)
    {
        //
    }

    //Edite: mandar para a tela de editar registro

    public function edit(Post $postModel, $idpost)
    {
        if (!$postModel = Post::find($idpost)) {
            return redirect()->back();
        }
        $post = $postModel->edit($idpost);
        return view('posts/edit', [
            'post' => $post
        ]);
    }

    public function updateDestaque(Request $request, Post $postModel)
    {

        $status = ($request->input('status') == 'true') ? 'on' : 'off';
        $postModel->updateDestaque($request->input('id'), $status);

        return response()->json(['status', 'Destaque alterado com sucesso']);

    }

    //Update: atualizar registro de postagem
    public function update(Request $request, Post $postModel)
    {
        $mensagens = [

            //Tipo
            'tipo_post.required' => 'Selecione um tipo',

            //titulo
            'titulo_post.required' => 'O campo titulo é obrigatório',
            'titulo_post.min' => 'O titulo deve ter pelo menos 5 caracteres.',

            //texto
            'texto_post.required' => 'O campo texto é obrigatório',
            'texto_post.min' => 'O campo texto deve ter pelo menos 5 caracteres.',

        ];

        $request->validate([
            'tipo_post' => 'required|nullable',
            'titulo_post' => 'required|nullable|min:5',
            'texto_post' => 'required|nullable|min:5',
        ], $mensagens);

        $id = $request->input('id_post');
        $ip = $request->input('ip');
        $titulo = $request->input('titulo_post');
        $sub_titulo = $request->input('sub_titulo_post');
        $descr = $request->input('descr');
        // $foto = $request->input('foto_post');
        $foto2 = $request->input('foto2');
        $legenda = $request->input('legenda');
        $texto = $request->input('texto');
        $video = $request->input('video');
        $por = $request->input('por');
        $tipo = $request->input('tipo');
        $link = $request->input('link');
        $destaque = $request->input('destaque');
        $status = $request->input('status_post');

        //@fix-me verificar configurações da pasta public no storage
        //  $foto = $request->foto1_post->store('public/post');

        if ($request->hasFile('foto1_post') && $request->file('foto1_post')->isValid()) {
            $foto = $request->foto1_post->store('public/post');
        } else {
            $foto = $request->input('foto1_posts_db');
        };

        $data = $request->input('dataPost');
        
        $postModel->updatePost($id, $ip, $titulo, $sub_titulo, $descr, $foto, $foto2, $legenda, $texto, $video, $por, $tipo, $link, $destaque, $status, $data);
        return redirect('posts');
    }

    //Destroy função para apagar registro de postagem

    public function destroy(Post $postModel, $id)
    {
        $postModel->destroyPost($id);
        return response()->json(['status', 'Deletado com sucesso']);
    }
}

