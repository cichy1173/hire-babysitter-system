<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Opinion;
use Illuminate\Support\Facades\Auth;

class ShowUserController extends Controller
{
    public function index(User $user)
    {
        $opinionAvailable = 0;
        $blocked = $user->is_blocked;

        if(auth()->check() && auth()->user()->id_account_type == 1)
        {
            $applications = auth()->user()->myApplications;
            
            foreach ($applications as $key => $application) 
            {
                if(($application->id_user == $user->id) && ($application->pivot->accepted == 1) && ($application->pivot->time_to < now()))
                {
                    $opinionAvailable = 1;
                }
            }
        }
        elseif(auth()->check() && auth()->user()->id_account_type == 2)
        {
            if(DB::table('users_advertisements')->where([['id_user', $user->id], ['accepted', 1], ['time_to', '<', now()]])->count() > 0)
            {
                $opinionAvailable = 1;
            }
        }
   
        $user = User::select('id' ,'name', 'surname', 'nickname', 'reputation', 'photo', 'about', 'is_blocked', 'id_account_type')
                        ->where('id', $user->id)->get();
        
        $opinions = Opinion::where('to_id_user', $user[0]->id)->paginate(4);

        return view('User.showUser', [
            'user' => $user[0],
            'opinionAvailable' => $opinionAvailable,
            'opinions' => $opinions,
            'blocked' => $blocked
        ]);
    }


    public function destroy($id)
    {
        $user = User::find($id);

        foreach ($user->sendMessages as $key => $value) {
            $value->from_id_user = 1;
            $value->save();
        }
        //$user->receivedMessages()->delete();
        foreach ($user->receivedMessages as $key => $value) {
            $value->to_id_user = 1;
            $value->save();
        }

        
         User::destroy($id);
         return redirect()->route('homePage')->with('status', 'Użytkownik został usunięty');
    }
}
