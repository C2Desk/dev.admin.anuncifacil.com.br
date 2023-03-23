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

    public function create(){
        return view('/account/register');
    }
    public function paginacao()
    {

        $id = Account::when(request('nome') != null, function ($query) {
            return $query->where('name', 'like', '%' . request('nome') . '%');
        })->orderBy('id', 'DESC')->paginate(15);
        return view('account.list')->with('accounts', $id);
    }

}
