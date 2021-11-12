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
   
            $user = User::select('id' ,'name', 'surname', 'nickname', 'reputation', 'photo', 'about', 'is_blocked')
                            ->where('id', $user->id)->get();
            return view('User.showUser', [
                'user' => $user[0]
            ]);
    }


    public function destroy($id)
    {
        $user = User::find($id);

        foreach ($user->sendMessages as $key => $value) {
            $value->from_id_user = 1;
            $value->save();
        }
        //$user->recievedMessages()->delete();
        foreach ($user->recievedMessages as $key => $value) {
            $value->to_id_user = 1;
            $value->save();
        }

        
         User::destroy($id);
         return redirect()->route('homePage')->with('status', 'Użytkownik został usunięty');
    }
}
