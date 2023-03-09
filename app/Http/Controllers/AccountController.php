<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;

class AccountController extends Controller
{
    public function profile(){
        return view('/account/index');
    }
    public function users(){
        return view('/account/users');
    }
    public function paginacao()
    {

        $id = Account::when(request('nome') != null, function ($query) {
            return $query->where('titulo', 'like', '%' . request('nome') . '%');
        })->orderBy('id', 'DESC')->paginate(15);
        return view('posts.list')->with('posts', $id);
    }

}
