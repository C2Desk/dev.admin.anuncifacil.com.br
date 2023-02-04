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
    public function index(Publicidade $publicidadeModel)
    {
        $publicidade = $publicidadeModel->getPublicidade();
        return view('publicidade/index', [
            'publicidade' => $publicidade
        ]);
    }
}
