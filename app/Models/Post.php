<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    public function getPosts()
    {
        return DB::select("SELECT * FROM posts WHERE foto LIKE '%http://%' order by id desc");

    }

    public function savePost($ip, $titulo, $sub_titulo, $descr, $foto, $foto2, $legenda, $texto, $video, $por, $tipo, $link, $destaque, $status, $data = null)
    {
        $dataPost = ($data == null) ? date("Y:m:d") : $data;

        try {
            $sql = "INSERT INTO anuncifacil.posts 
            (ip, no_id, `data`, hora, titulo, sub_titulo, descr, foto, foto2, legenda, texto, video, por, link, tipo, destaque, status, cliques)
            VALUES('" . $ip . "', 0, '" . $dataPost . "', '" . date("H:m:i") . "', '" . $titulo . "', '" . $sub_titulo . "', '" . $descr . "', '" . $foto . "', '" . $foto2 . "', '" . $legenda . "', '" . $texto . "', '" . $video . "', '" . $por . "', '" . $link . "', '" . $tipo . "', '" . $destaque . "', '" . $status . "', 0)";
            
            DB::insert($sql);

            return true;
        } catch (\Throwable $th) {
            throw new Exception("Erro ao inserir os dados do post no banco de dados" . $th);
        }
    }
}
