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
        return view('User.Availability.index');
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
