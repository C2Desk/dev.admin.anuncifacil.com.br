<?php

namespace App\Http\Controllers;

use App\Models\Dash;
use Illuminate\Http\Request;

class DashController extends Controller
{
    public function index(Dash $dashModel)
    {
        $dash = $dashModel->getdash();
        return view('welcome');
    }
}
