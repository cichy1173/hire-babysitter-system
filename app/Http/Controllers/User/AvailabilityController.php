<?php

namespace App\Http\Controllers\User;

use App\Models\Availability;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $monday = Availability::where('day', '1')->where('id_user', $user)->first();
        $tuesday = Availability::where('day', '2')->where('id_user', $user)->first();
        $wednesday = Availability::where('day', '3')->where('id_user', $user)->first();
        $thursday = Availability::where('day', '4')->where('id_user', $user)->first();
        $friday = Availability::where('day', '5')->where('id_user', $user)->first();
        $saturday = Availability::where('day', '6')->where('id_user', $user)->first();
        $sunday = Availability::where('day', '7')->where('id_user', $user)->first();


        return view('User.Availability.index', [
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
            'sunday' => $sunday,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($day)
    {
        $when = $day;
        $user = Auth::user()->id;

        return view('User.Availability.edit', [
            'day' => $day,
            'user' =>$user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $day)
    {
        $id = Auth::user()->id;
        $available = Availability::where('day', $day)->where('id_user', $id)->first();

        $this->validate($request, [
            'start_time' => 'required|date',  
            'stop_time' => 'required|date|after:start_time',
        ]);
    

        if($available == null) {
            Availability::create([
                'start_time' => $request -> start_time,
                'stop_time' => $request -> stop_time,
                'day' => $day,
                'id_user' => $id,
                
            ]);
        }

        else {
            $available->update([
                'start_time' => $request -> start_time,
                'stop_time' => $request -> stop_time,
               
            ]);
        }

        return redirect()->route('availability.availability.index')
            ->with('success', 'Pomyślnie zaktualizowano dostępność!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
