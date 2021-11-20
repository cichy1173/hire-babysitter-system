<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $this->validate($request, [
            'search' => 'required|string|max:100'
        ]);
        
        $adverts = Advertisement::search($request->search)->paginate(5);

        foreach ($adverts as $key => $value) {
            $value['user'] = User::find($value->id_user);
            $value['district'] = $value->districts->first();
            $value['city'] = City::find($value['district']->id_city);
        }

        $users = User::search($request->search)->paginate(5);
        
        return view('search', [
            'adverts' => $adverts,
            'users' => $users
        ]);
    }
}
