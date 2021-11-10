<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowUserController extends Controller
{
    public function index(User $user)
    {
   
            $user = User::select('id' ,'name', 'surname', 'nickname', 'reputation', 'photo', 'about')
                            ->where('id', $user->id)->get();
            return view('User.showUser', [
                'user' => $user[0]
            ]);
    }
}
