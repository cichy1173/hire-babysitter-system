<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(User $user)
    {
        if(auth()->user() != $user)
        {
            dd();
        }

        
    }
}
