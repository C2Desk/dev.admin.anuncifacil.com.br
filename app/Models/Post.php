<?php

namespace App\Models;

use App\Entities\posts\PostEntitie;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    public function getPosts()
    {
        return DB::select("SELECT * FROM posts WHERE foto LIKE '%http://%' order by id desc limit 50");

    }

    public function getPostById($postId)
    {
        return DB::selectOne("select * from posts where id = '" . $postId  . "'");
    }

    public function savePost(PostEntitie $post)
    {
        $dataPost = ($post->getData() == null) ? date("Y:m:d") : $post->getData();

        try {
            $sql = "INSERT INTO anuncifacil.posts 
            (ip, no_id, `data`, hora, titulo, sub_titulo, descr, foto, foto2, legenda, texto, video, por, link, tipo, destaque, status, cliques)
            VALUES('" . $post->getIp() . "', 0, '" . $dataPost . "', '" . date("H:m:i") . "',
            '" . $post->getTitulo() . "', '" . $post->getSub_titulo() . "', '" . $post->getDescr() . "', '" . 
            $post->getfFoto() . "', '" . $post->getFoto2() . "', '" . $post->getLegenda() . "', '" . 
            $post->getTexto() . "', '" . $post->getvideo() . "', '" . 
            $post->getPor() . "', '" . $post->getLink() . "', '" . $post->getTipo() . "', '" . $post->getDestaque() . "', '" . $post->getStatus() . "', 0)";
            
            // echo $sql; die;

            DB::insert($sql);

            return true;
        } catch (\Throwable $th) {
            throw new Exception("Erro ao inserir os dados do post no banco de dados" . $th);
        }
    }
}
