<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    //Select de postagens

    public function getPosts()
    {
        $posts = DB::table('posts')->select('*')->orderBy('id', 'DESC')->paginate(10);
        return $posts;
    }

    //Insert de postagem

    public function savePost($ip, $titulo, $sub_titulo, $descr, $foto, $foto2, $legenda, $texto, $video, $por, $tipo, $link, $destaque, $status, $data = null)
    {
        $dataPost = ($data == null) ? date("Y-m-d") : $data;
        // $dataPost = ($data == null) ? date("d/m/Y H:i:s") : $data;

        try {
            $sql = "INSERT INTO anuncifacil.posts
            (ip, no_id, `data`, hora, titulo, sub_titulo, descr, foto, foto2, legenda, texto, video, por, link, tipo, destaque, status, cliques)
            VALUES('" . $ip . "', 0, '" . $dataPost . "', '" . date("H:m:i") . "', '" . $titulo . "', '" . $sub_titulo . "', '" . $descr . "', '" . $foto . "', '" . $foto2 . "', '" . $legenda . "', '" . $texto . "', '" . $video . "', '" . $por . "', '" . $link . "', '" . $tipo . "', '" . $destaque . "', '" . $status . "', 0)";
            // -- VALUES('" . $ip . "', 0, '" . $dataPost . "', '" . date("d/m/Y H:i:s") . "', '" . $titulo . "', '" . $sub_titulo . "', '" . $descr . "', '" . $foto . "', '" . $foto2 . "', '" . $legenda . "', '" . $texto . "', '" . $video . "', '" . $por . "', '" . $link . "', '" . $tipo . "', '" . $destaque . "', '" . $status . "', 0)";

            DB::insert($sql);

            return true;
        } catch (\Throwable $th) {
            throw new Exception("Erro ao inserir os dados do post no banco de dados" . $th);
        }
    }

    //Resgatar informação para a tela de edit

    public function edit($id)
    {
        $posts = DB::table('posts')->select('*')->where('id', $id)->paginate(10);
        return $posts;
    }

    //Update de postagem

    public function updatePost($id, $ip, $titulo, $sub_titulo, $descr, $foto, $foto2, $legenda, $texto, $video, $por, $tipo, $link, $destaque, $status, $data = null)
    {
        $dataPost = ($data == null) ? date("Y:m:d") : $data;
        try {
            $sql = "UPDATE anuncifacil.posts SET ip = 'asd', no_id = 10, data =  '2009-07-21', hora = '00:00:00', titulo = '$titulo', sub_titulo = '$sub_titulo',foto = '$foto',status = '$status' WHERE id = $id;";

            DB::update($sql);

            return true;
        } catch (\Throwable $th) {
            throw new Exception("Erro ao inserir os dados do post no banco de dados" . $th);
        }
    }

    //Delete da postagem

    public function destroyPost($id)
    {
        try {
            $sql = "DELETE FROM anuncifacil.posts WHERE id = $id";
            DB::delete($sql);
            return true;
        } catch (\Throwable $th) {
            throw new Exception("Erro ao inserir os dados do post no banco de dados" . $th);
        }
    }

    public function updateDestaque($id, $status)
    {
        try {
            DB::update("UPDATE posts set status = '{$status}' WHERE id = '{$id}'");

            return true;
        } catch (\Throwable $th) {
            throw new Exception("Erro ao alterar os dados" . $th);
        }
    }
}
