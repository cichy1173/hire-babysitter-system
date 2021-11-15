<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
        return view('admin.users.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:128',  
            'surname' => 'required|max:128', 
            'email' => 'required|email', 
            'password' => 'required|max:128|min:8',
            'id_account_type' => 'required',
            'nickname' => 'required|max:15'
        ]);

        $user =  User::create([
            'name' => $request -> name,
            'surname' => $request -> surname,
            'email' => $request -> email,
            'nickname' => $request -> nickname,
            'password'=> Hash::make($request -> password),
            'id_account_type' => $request -> id_account_type,
            
        ]);

        return redirect()->route('admin.users.index')->with('success', "Użytkownik został pomyślnie utworzony!");
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
        

        return view('admin.users.edit', [
            'user' => User::find($id)
        ]);
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
        $user = User::find($id);

        $this->validate($request, [
            'name' => 'required|max:128',  
            'surname' => 'required|max:128', 
            'email' => 'required|email', 
            'id_account_type' => 'required',
            'nickname' => 'required|max:15',
            'about' => 'max:5000'
        ]);

        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->id_account_type = $request->id_account_type;
        $user->nickname = $request->nickname;
        $user->about = $request->about;


        $user->save();

        return back()->with('success', 'Użytkownik wyedytowany pomyślnie');
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
     * 
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
 
       return back()->with('success', "Użytkownik pomyślnie zablokowany!");

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

      
      return back()->with('success', "Użytkownik pomyślnie odblokowany!");

    }

    public function makeAdmin($id)
    {
        $user = User::find($id);

        $user->id_account_type = '3';
        $user->save();

        return back()->with('success', "Użytkownik pomyślnie mianowany administratorem!");
    }
}


