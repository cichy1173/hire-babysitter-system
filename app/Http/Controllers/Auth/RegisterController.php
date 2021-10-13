<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',  
            'surname' => 'required|max:255', 
            'email' => 'required|email', 
            'password' => 'required|confirmed|max:255',
            'id_account_type' => 'required',
            'nickname' => 'required|max:15'
        ]);
        
        User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' =>$request->email,
            'nickname' => $request -> nickname,
            'password'=> Hash::make($request -> password),
            'id_account_type' => $request ->id_account_type,
            
        ]);

        auth()->attempt($request->only('email', 'password'));

        return redirect()->route('dashboard');
    }
}
