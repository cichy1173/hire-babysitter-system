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

        $messages = $user->sendMessages;
        $messages = $messages->merge($user->recievedMessages);

        $messages = $messages->sortByDesc('created_at');
        dd($messages, $user);
    }
}
