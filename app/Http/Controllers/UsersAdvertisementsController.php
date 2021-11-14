<?php

namespace App\Http\Controllers;

use App\Models\Users_Advertisements;
use Illuminate\Http\Request;


class UsersAdvertisementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('calendar', [

            'cals' =>Users_Advertisements::paginate(7)
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
     * @param  \App\Models\Users_Advertisements  $users_Advertisements
     * @return \Illuminate\Http\Response
     */
    public function show(Users_Advertisements $users_Advertisements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Users_Advertisements  $users_Advertisements
     * @return \Illuminate\Http\Response
     */
    public function edit(Users_Advertisements $users_Advertisements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Users_Advertisements  $users_Advertisements
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users_Advertisements $users_Advertisements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Users_Advertisements  $users_Advertisements
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users_Advertisements $users_Advertisements)
    {
        //
    }
}
