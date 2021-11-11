<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowUserController extends Controller
{
    public function index(User $user)
    {
        $opinionAvailable = 0;

        if(auth()->user()->id_account_type == 1)
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
        elseif(auth()->user()->id_account_type == 2)
        {
            if(DB::table('users_advertisements')->where([['id_user', $user->id], ['accepted', 1], ['time_to', '<', now()]])->count() > 0)
            {
                $opinionAvailable = 1;
            }
        }
   
        $user = User::select('id' ,'name', 'surname', 'nickname', 'reputation', 'photo', 'about')
                        ->where('id', $user->id)->get();
        return view('User.showUser', [
            'user' => $user[0],
            'opinionAvailable' => $opinionAvailable
        ]);
    }
}
