<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{


    public function __construct()
    {
        $this->middleware(['guest']);
    }



    public function index()
    {


        return view('auth.login');
    }

    public function store(Request $request)
    {
        

        $this->validate($request, [
            
            'email' => 'required|email', 
            'password' => 'required',
            
        ]);

       if (!(auth()->attempt($request->only('email', 'password'), $request->remember))) {
           return back()->with('status', 'Błędne dane logowania');
       }

       if((Auth::user()->is_blocked) == '1') {
            auth()->logout();
            return back()->with('status', 'Twoje konto jest zablokowane');
       } 


       return redirect()->route('dashboard');

    }
}
