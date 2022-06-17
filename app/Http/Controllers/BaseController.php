<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index()
    {
        $users = cache('users', function (){
            return User::paginate(100);
        });
        //$users = \App\Models\User::get();
        return view('test', compact('users'));
    }
}
