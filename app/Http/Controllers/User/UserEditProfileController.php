<?php

namespace App\Http\Controllers\User;


use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserEditProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index()
    {
        return view('User.index');
    }


    public function destroy(User $user)
    {

        $user = Auth::user()->id;

        User::destroy($user);

        return redirect(route('login'))->with('destroyed', 'Konto usunięte');

    }


}
