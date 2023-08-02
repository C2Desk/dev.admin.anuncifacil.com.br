<?php

namespace App\Http\Controllers;


use App\Models\Publicidade;
use Illuminate\Http\Request;

class PubController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Idex: chamar tela index

    public function index(Publicidade $publicidadeModel)
    {
        $publicidade = $publicidadeModel->getPublicidade();
        return view('publicidade/index', [
            'publicidade' => $publicidade
        ]);
    }

    //Paginação: chamar a lista de postagens na tela

    public function paginacao()
    {
        $id = Publicidade::when(request('nome') != null, function ($query) {
            return $query->where('titulo', 'like', '%' . request('nome') . '%');
        })->orderBy('id', 'DESC')->paginate(5);
        return view('publicidade.list')->with('publicidade', $id);
    }

    //Create: mandar para a pagina de criação de nova postagem.

    public function create()
    {
        return view('publicidade/create');
    }

    //Store: manda as informações do formulario pra model de postagem.

    public function store(Request $request, Publicidade $pubModel)
    {

        $mensagens = [

            //Tipo
            'tipo_pub.required' => 'Selecione um tipo',

            //titulo

            'titulo_pub.required' => 'O campo titulo é obrigatório',
            'titulo_pub.min' => 'O titulo deve ter pelo menos 5 caracteres.',

            //email

            'email_pub.required' => 'O campo E-mail é obrigatório',
            'email_pub.email' => 'Digite um email válido! formato (email@domain)',

            //telefone

            'telefone_pub.max' => 'Número inválido',

            //valor

            'valor_pub.required' => 'Campo valor é obrigatório',

        ];
        $request->validate([

            'tipo_pub' => 'required|nullable',
            'titulo_pub' => 'required|nullable|min:5',
            'email_pub' => 'required|email',
            'telefone_pub' => 'max:18',
            'valor_pub' => 'required',

        ], $mensagens);

        $tipo = $request->input('tipo_pub');
        $titulo = $request->input('titulo_pub');
        $email = $request->input('email_pub');
        $telefone = $request->input('telefone_pub');
        $link = $request->input('link_pub');
        $venc = $request->input('venc_pub');
        $valor = $request->input('valor_pub');
        $status = $request->input('status_pub');
        $texto = $request->input('texto_pub');

        //@fix-me verificar configurações da pasta public no storage
        $foto1 = $request->foto1_pub->store('public/image');
        $pubModel->savePub($texto, $tipo, $titulo, $email, $telefone, $link, $foto1, $venc, $status, $valor);
      //  return view('publicidade/create');
        return redirect('publicidade');
    }

    //Edite: mandar para a tela de editar registro

    public function edit(Publicidade $pubModel, $idpub)
    {
        $publicidade = $pubModel->edit($idpub);
        return view('publicidade/edit', [
            'publicidade' => $publicidade
        ]);
    }

    //Update: atualizar registro de postagem

    public function update(Request $request, Publicidade $pubModel, $id)
    {

        $mensagens = [

            //Tipo

            'tipo_pub.required' => 'Selecione um tipo',

            //titulo

            'titulo_pub.required' => 'O campo titulo é obrigatório',
            'titulo_pub.min' => 'O titulo deve ter pelo menos 5 caracteres.',

            //email

            'email_pub.required' => 'O campo E-mail é obrigatório',
            'email_pub.email' => 'Digite um email válido! formato (email@domain)',

            //telefone

            'telefone_pub.max' => 'Número inválido',

            //valor

            'valor_pub.required' => 'Campo valor é obrigatório',

        ];
        $request->validate([
            'tipo_pub' => 'required|nullable',
            'titulo_pub' => 'required|nullable|min:5',
            'email_pub' => 'required|email',
            'telefone_pub' => 'max:18',
            'valor_pub' => 'required',
        ], $mensagens);

        $id = $request->input('id_pub');
        $tipo = $request->input('tipo_pub');
        $titulo = $request->input('titulo_pub');
        $email = $request->input('email_pub');
        $telefone = $request->input('telefone_pub');
        $link = $request->input('link_pub');
        $venc = $request->input('venc_pub');
        $valor = $request->input('valor_pub');
        $status = $request->input('status_pub');

        if ($request->hasFile('foto1_pub') && $request->file('foto1_pub')->isValid()) {
            $foto1 = $request->foto1_pub->store('public/image');
        } else {
            $foto1 =  $request->input('foto1_pub_db');
        };

        $data = $request->input('data');
        $pubModel->updatePub($id, $tipo, $titulo, $email, $telefone, $link, $foto1, $venc, $status, $valor);
        return redirect('publicidade');
    }

    //Pdf: Fazer a extração em pdf dos dados de publicidade

    public function pdf(Publicidade $pubModel)
    {
        $pubModel->exportPdf();
        return view('publicidade/create');
    }

    //Destroy função para apagar registro de postagem

    public function destroy(Publicidade $pubModel, $id)
    {
        $pubModel->destroyPost($id);

        return response()->json(['status', 'Deletado com sucesso']);
    }

    //Upload de imagem dentro do rich text

    public function uploadimage(Request $request)
    {

        if ($request->hasFile('upload')) {
            $originName = $request->file("upload")->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientoriginalExtension();
            $fileName = $fileName . '-' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('media/' . $fileName);
            return response()->json([' fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }


    public function recibo(Publicidade $pubModel, $idpub)
    {
        $publicidade = $pubModel->recibo($idpub);


        return view('publicidade/edit', [
            'publicidade' => $publicidade
        ]);
    }
    public function recibos(Publicidade $pubModel)
    {
        $publicidade = $pubModel->recibos();


        return view('publicidade/edit', [
            'publicidade' => $publicidade
        ]);
    }
}
