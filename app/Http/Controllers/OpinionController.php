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
        return view('User.userOpinion', [
            'opinions' => $opinions
        ]);
    }

    public function addOpinion(User $user)
    {
        return redirect()->back()->with('status', 'Pomyślnie dodano opinię');
    }
}
