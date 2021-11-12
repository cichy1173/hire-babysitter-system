<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Opinion;
use Illuminate\Http\Request;

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

        auth()->user()->sendOpinions()->create([
            'content' => $request->opinionContent,
            'grade' => $request->opinionGradeRadio,
            'create_date' => now(),
            'from_id_user' => auth()->id(),
            'to_id_user' => $user->id
        ]);

        $opinions = $user->recievedOpinions();
        $counter = $opinions->count();
        $sum = 0;

        foreach ($opinions as $key => $item) {
            $sum += $item->grade;
        }

        $user->update([
            'reputation' => round($sum / $counter)
        ]);

        return redirect()->back()->with('status', 'Pomyślnie dodano opinię');
    }
}
