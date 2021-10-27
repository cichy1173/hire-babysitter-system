<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $results = Advertisement::select('id', 'id_advertisement_type', 'id_user', 'title', 'hour_rate', 'child_num', 'created_at')->get();

        $array = array();
    
        foreach ($results as $key => $value) {
            $district = Advertisement::find($value['id'])->districts[0];
            $city = City::find($district['id_city']);
            $array[$key] = $value;
            $array[$key]['city'] = $city['city_name'];
            $array[$key]['district'] = $district['district_name'];
        }

        $total = count($results);
        $per_page = 1;
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
}
