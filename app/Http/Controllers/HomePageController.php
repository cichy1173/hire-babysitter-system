<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $results = Advertisement::select('id', 'id_advertisement_type', 'id_user', 'title', 'hour_rate', 'child_num', 'created_at')->get()->sortByDesc('created_at');

        $array = array();
    
        foreach ($results as $key => $value) {
            $district = Advertisement::find($value['id'])->districts[0];
            $city = City::find($district['id_city']);
            $user = User::find($value['id_user']);
            $array[$key] = $value;
            $array[$key]['city'] = $city['city_name'];
            $array[$key]['district'] = $district['district_name'];
            $array[$key]['user_nick'] = $user->nickname;
        }

        $total = count($results);
        $per_page = 5;
        $current_page = $request->input('page') ?? 1;
        $starting_point = ($current_page * $per_page) - $per_page;

        $array = array_slice($array, $starting_point, $per_page, true);

        $array = new Paginator($array, $total, $per_page, $current_page, [
            'path' => $request->url(),
            'query' => $request->query()
        ]);

        //dd($array);

        return view('index', [
            'adverts' => $array
        ]);
    }

    public function singleAdvert(Advertisement $advert)
    {
        return redirect()->route('showSingle', $advert);
    }
}
