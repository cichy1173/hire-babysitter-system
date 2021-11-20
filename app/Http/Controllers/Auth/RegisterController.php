<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{


    public function __construct()
    {
        $this->middleware(['guest']);
    }


    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:128',  
            'surname' => 'required|max:128', 
            'email' => 'required|unique:users|email', 
            'password' => 'required|confirmed|max:128|min:8',
            'id_account_type' => 'required',
            'nickname' => 'required|unique:users|max:15'
        ]);

        $id = User::create([
            'name' => $request -> name,
            'surname' => $request -> surname,
            'email' => $request -> email,
            'nickname' => $request -> nickname,
            'password'=> Hash::make($request -> password),
            'id_account_type' => $request -> id_account_type,
            
        ])->id;

        User::find($id)->searchable();

        return back()->with('registered', 'Pomyślnie zarejestrowano!');

    }
}


