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

        $items = array();

        $user = User::find(auth()->id());

        $items['receivedOpinions'] = $user->receivedOpinions->sortByDesc('created_at');
        $items['sendOpinions'] = $user->sendOpinions->sortByDesc('created_at');

        foreach ($items['receivedOpinions'] as $key => $opinion) 
        {
            $opinion['user'] = User::find($opinion->from_id_user);
        }

        foreach ($items['sendOpinions'] as $key => $opinion) 
        {
            $opinion['user'] = User::find($opinion->to_id_user);
        }
        

        return view('User.userOpinion', [
            'items' => $items
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

            $adverts = $user->advertisements;

            foreach ($adverts as $key => $advert) {
                if(DB::table('users_advertisements')->where([
                    ['id_advertisement', $advert->id],
                    ['id_user', auth()->id()],
                    ['accepted', 1],
                    ['read_by_parent', 1],
                    ['read_by_nanny', 1],
                    ['created_user_opinion', 0],
                    ['time_to', '<', now()]
                    ])->count() > 0)
                {
                    DB::table('users_advertisements')->where([
                        ['id_advertisement', $advert->id],
                        ['id_user', auth()->id()],
                        ['accepted', 1],
                        ['read_by_parent', 1],
                        ['read_by_nanny', 1],
                        ['created_user_opinion', 0],
                        ['time_to', '<', now()]
                        ])->update(['created_user_opinion' => 1]);

                    auth()->user()->sendOpinions()->create([
                        'content' => $request->opinionContent,
                        'grade' => $request->opinionGradeRadio,
                        'create_date' => now(),
                        'from_id_user' => auth()->id(),
                        'to_id_user' => $user->id
                    ]);
            
                    $opinions = $user->receivedOpinions;
                    $counter = $opinions->count();
                    $sum = 0;
            
                    foreach ($opinions as $key => $item) {
                        $sum += $item->grade;
                    }
            
                    $avarage = round($sum / $counter);
            
                    $avarage = intval($avarage);
            
                    $user->reputation = $avarage;
                    $user->save();
            
                    return redirect()->back()->with('success', 'Pomyślnie dodano opinię');
                }
            }

            $adverts = auth()->user()->advertisements;

            foreach ($adverts as $key => $advert) {
                if(DB::table('users_advertisements')->where([
                    ['id_advertisement', $advert->id],
                    ['id_user', $user->id],
                    ['accepted', 1],
                    ['read_by_parent', 1],
                    ['read_by_nanny', 1],
                    ['created_user_opinion', 0],
                    ['time_to', '<', now()]
                    ])->count() > 0)
                {
                    DB::table('users_advertisements')->where([
                        ['id_advertisement', $advert->id],
                        ['id_user', $user->id],
                        ['accepted', 1],
                        ['read_by_parent', 1],
                        ['read_by_nanny', 1],
                        ['created_user_opinion', 0],
                        ['time_to', '<', now()]
                        ])->update(['created_user_opinion' => 1]);

                    auth()->user()->sendOpinions()->create([
                        'content' => $request->opinionContent,
                        'grade' => $request->opinionGradeRadio,
                        'create_date' => now(),
                        'from_id_user' => auth()->id(),
                        'to_id_user' => $user->id
                    ]);
            
                    $opinions = $user->receivedOpinions;
                    $counter = $opinions->count();
                    $sum = 0;
            
                    foreach ($opinions as $key => $item) {
                        $sum += $item->grade;
                    }
            
                    $avarage = round($sum / $counter);
            
                    $avarage = intval($avarage);
            
                    $user->reputation = $avarage;
                    $user->save();
            
                    return redirect()->back()->with('success', 'Pomyślnie dodano opinię');
                }
            }
        }
        elseif(auth()->user()->id_account_type == 1)
        {
            $adverts = $user->advertisements;

            foreach ($adverts as $key => $advert) {
                if(DB::table('users_advertisements')->where([
                    ['id_advertisement', $advert->id],
                    ['id_user', auth()->id()],
                    ['accepted', 1],
                    ['read_by_parent', 1],
                    ['read_by_nanny', 1],
                    ['created_supervisor_opinion', 0],
                    ['time_to', '<', now()]
                    ])->count() > 0)
                {
                    DB::table('users_advertisements')->where([
                        ['id_advertisement', $advert->id],
                        ['id_user', auth()->id()],
                        ['accepted', 1],
                        ['read_by_parent', 1],
                        ['read_by_nanny', 1],
                        ['created_supervisor_opinion', 0],
                        ['time_to', '<', now()]
                        ])->update(['created_supervisor_opinion' => 1]);

                    auth()->user()->sendOpinions()->create([
                        'content' => $request->opinionContent,
                        'grade' => $request->opinionGradeRadio,
                        'create_date' => now(),
                        'from_id_user' => auth()->id(),
                        'to_id_user' => $user->id
                    ]);
            
                    $opinions = $user->receivedOpinions;
                    $counter = $opinions->count();
                    $sum = 0;
            
                    foreach ($opinions as $key => $item) {
                        $sum += $item->grade;
                    }
            
                    $avarage = round($sum / $counter);
            
                    $avarage = intval($avarage);
            
                    $user->reputation = $avarage;
                    $user->save();
            
                    return redirect()->back()->with('success', 'Pomyślnie dodano opinię');
                }
            }

            $adverts = auth()->user()->advertisements;

            foreach ($adverts as $key => $advert) {
                if(DB::table('users_advertisements')->where([
                    ['id_advertisement', $advert->id],
                    ['id_user', $user->id],
                    ['accepted', 1],
                    ['read_by_parent', 1],
                    ['read_by_nanny', 1],
                    ['created_supervisor_opinion', 0],
                    ['time_to', '<', now()]
                    ])->count() > 0)
                {
                    DB::table('users_advertisements')->where([
                        ['id_advertisement', $advert->id],
                        ['id_user', $user->id],
                        ['accepted', 1],
                        ['read_by_parent', 1],
                        ['read_by_nanny', 1],
                        ['created_supervisor_opinion', 0],
                        ['time_to', '<', now()]
                        ])->update(['created_supervisor_opinion' => 1]);

                    auth()->user()->sendOpinions()->create([
                        'content' => $request->opinionContent,
                        'grade' => $request->opinionGradeRadio,
                        'create_date' => now(),
                        'from_id_user' => auth()->id(),
                        'to_id_user' => $user->id
                    ]);
            
                    $opinions = $user->receivedOpinions;
                    $counter = $opinions->count();
                    $sum = 0;
            
                    foreach ($opinions as $key => $item) {
                        $sum += $item->grade;
                    }
            
                    $avarage = round($sum / $counter);
            
                    $avarage = intval($avarage);
            
                    $user->reputation = $avarage;
                    $user->save();
            
                    return redirect()->back()->with('success', 'Pomyślnie dodano opinię');
                }
            }

        }

        return redirect()->back()->with('error', 'Nie możesz wystawić opinii temu użytkownikowi');
    }
}
