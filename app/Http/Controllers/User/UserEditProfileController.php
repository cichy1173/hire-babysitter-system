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

    public function resetPswd(User $user)
    {
        $user = Auth::user()->email;

        

        Auth::logout();

        return redirect('/password/reset')->with('stat', $user);

    }

    //description

    public function showDescriptionBlade(User $about)
    {
        $about = Auth::user()->about;
        return view('User.description')->with('about', $about);
    }

    public function storeAbout(Request $request, User $user)
    {
        $user =Auth::user()->id;
        User::find(Auth::user()->id)->update([
            'about' => $request->about,
           
        ]);

        return redirect('/user/edit');

    }


}
