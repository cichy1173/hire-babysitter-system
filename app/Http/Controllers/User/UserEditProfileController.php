<?php

namespace App\Http\Controllers\User;


use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserEditProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('User.index');
    }


    public function destroy()
    {
        $user = auth()->user();
        //$user->sendMessages
        foreach ($user->sendMessages as $key => $value) {
            $value->from_id_user = 1;
            $value->save();
        }
        //$user->recievedMessages()->delete();
        foreach ($user->recievedMessages as $key => $value) {
            $value->to_id_user = 1;
            $value->save();
        }

        //TODO: dodać usuwanie zdjęcia użytkownika z pamięci

        User::destroy($user->id);

        return redirect(route('login'))->with('destroyed', 'Konto usunięte');

    }

    public function resetPswd(User $user)
    {
        $user = Auth::user()->email;

        

        Auth::logout();

        return redirect('/password/reset')->with('stat', $user);

    }

    //description

    public function showDescriptionBlade(User $about)
    {
        $about = Auth::user()->about;
        return view('User.description')->with('about', $about);
    }

    public function storeAbout(Request $request, User $user)
    {

        $this->validate($request, [
            'about' => 'max:5000',  
            
        ]);

        $user =Auth::user()->id;
        User::find(Auth::user()->id)->update([
            'about' => $request->about,
           
        ]);

        return redirect(route('userEdit'))->with('success', 'Opis został pomyślnie zaktualizowany!');

    }

    public function showNicknameBlade(User $nickname)
    {
        $nickname = Auth::user()->nickname;
        return view('User.nickname')->with('nickname', $nickname);
    }

    public function storeNickname(Request $request, User $user)
    {

        $this->validate($request, [
            'nickname' => 'required|max:15',  
            
        ]);

        $user =Auth::user()->id;
        User::find(Auth::user()->id)->update([
            'nickname' => $request->nickname,
           
        ]);

        return redirect(route('userEdit'))->with('success', 'Nazwa użytkownika (nickname) została pomyślnie zaktualizowana!');

    }

    public function showAccountTypeBlade(User $id_account_type)
    {
        $id_account_type = Auth::user()->id_account_type;
        return view('User.accountType')->with('id_account_type', $id_account_type);
    }

    public function storeAccountType(Request $request, User $user)
    {

        $this->validate($request, [
            'id_account_type' => 'required',  
            
        ]);

        $user =Auth::user()->id;
        User::find(Auth::user()->id)->update([
            'id_account_type' => $request->id_account_type,
           
        ]);

        return redirect(route('userEdit'))->with('success', 'Typ konta został pomyślnie zmieniony!');

    }


    public function showPhotoBlade(User $photo)
    {
        $photo = Auth::user()->photo;
        return view('User.photo')->with('photo', $photo);
    }

    public function storePhoto(Request $request, User $user)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,gif,png|file|max:4096',  
            
        ]);

       $path = $request->file('photo')->store('public/profilePhotos');

      

      $pathDatabase = str_replace('public', 'storage', $path);

    

       $user =Auth::user()->id;
        
        User::find(Auth::user()->id)->update([
            'photo' => $pathDatabase,
           
       ]);

       return redirect(route('userEdit'))->with('success', 'Zdjęcie zostało pomyślnie ustawione!');

    }


}
