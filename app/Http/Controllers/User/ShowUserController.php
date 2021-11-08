<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowUserController extends Controller
{
    public function index(User $user)
    {
        $user = User::select('name', 'surname', 'nickname', 'reputation', 'photo', 'about')
                        ->where('id', $user->id)->get();
        return view('User.showUser', [
            'user' => $user[0]
        ]);
    }
}
