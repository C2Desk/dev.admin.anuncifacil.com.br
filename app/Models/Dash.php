<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dash extends Model
{
    use HasFactory;

    public function getDash()
    {
        $click = DB::select(' SELECT cliques, SUBSTRING(data, 1, 4) AS ano
        FROM anuncifacil.posts GROUP BY ano');
      //  $click = DB::select('SELECT sum(cliques) as cliques FROM anuncifacil.posts  where data >= 2022');



        $dash = DB::select('SELECT cliques, por
        FROM anuncifacil.posts');

        //return $dash;
      //  return true;


    }
}
