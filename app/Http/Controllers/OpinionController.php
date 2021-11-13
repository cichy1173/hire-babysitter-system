<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OpinionController extends Controller
{
    public function index()
    {
        $opinions = Opinion::where('to_id_user', auth()->id())->get();

        $array = array();
        
        foreach ($opinions as $key => $value) {
            $item['user'] = User::find($value->from_id_user);
            $item['opinion'] = $value;
            array_push($array, $item);
        }

        return view('User.userOpinion', [
            'opinions' => $array
        ]);
    }

    public function addOpinion(User $user, Request $request)
    {

        $this->validate($request, [
            'opinionGradeRadio' => 'required|int|min:0|max:5',
            'opinionContent' => 'required|string|max:500'
        ]);

        if(auth()->user()->id_account_type == 2)
        {
            $list = DB::table('users_advertisements AS pivot')
                        ->join('users', 'users.id', '=', 'pivot.id_user')
                        ->join('advertisements AS advert', 'advert.id', '=', 'pivot.id_advertisement')
                        ->where([
                            ['pivot.id_user', $user->id],
                            ['pivot.time_to', '<', now()].
                            ['pivot.created_user_opinion', 0],
                            ['pivot.accepted', 1],
                            ['pivot.read_by_parent', 1],
                            ['pivot.read_by_nanny', 1]
                            ])
                        ->get();
            
            dd($list);
        }
        elseif(auth()->user()->id_account_type == 1)
        {
            
        }

        auth()->user()->sendOpinions()->create([
            'content' => $request->opinionContent,
            'grade' => $request->opinionGradeRadio,
            'create_date' => now(),
            'from_id_user' => auth()->id(),
            'to_id_user' => $user->id
        ]);

        $opinions = $user->recievedOpinions;
        $counter = $opinions->count();
        $sum = 0;

        foreach ($opinions as $key => $item) {
            $sum += $item->grade;
        }

        $avarage = round($sum / $counter);

        $avarage = intval($avarage);

        $user->reputation = $avarage;
        $user->save();

        return redirect()->back()->with('status', 'Pomyślnie dodano opinię');
    }
}
