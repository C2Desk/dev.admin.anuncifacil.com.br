<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function profile(){
        return view('/account/index');
    }
    public function users(){
        return view('/account/users');
    }
}
