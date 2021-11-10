<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.users.index', [
            'users' => User::paginate(10)
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
         return back()->with('success', 'Użytkownik został usunięty');
    }

    /**
     * Block the specified user 
     * '0' means unblocked user
     * '1' means blocked user
     * @param int $id
     */

    public function block($id)
    {
        $user = User::find($id);

       $user->is_blocked = '1';
       $user->save();

       return back()->with('success', "Użytkownik pomyślnie zablokowany");

    }

      /**
     * Unblock the specified user 
     * '0' means unblocked user
     * '1' means blocked user
     * @param int $id
     */

    public function unblock($id)
    {
       
        $user = User::find($id);
            
       $user->is_blocked = '0';
       $user->save();

       return back()->with('success', "Użytkownik pomyślnie odblokowany");

    }
}
