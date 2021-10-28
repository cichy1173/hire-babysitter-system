<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Voivodeship;
use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    public function add()
    {
        $countries = Country::all()->sortBy('country_name');
        $voivoideships = Voivodeship::all()->sortBy('voivodeship_name');
        $cities = City::all()->sortBy('city_name');
        $districts = District::all()->sortBy('district_name');


        return view('advertisements.add', [
            'countries' => $countries,
            'voivodeships' => $voivoideships,
            'cities' => $cities,
            'districts' => $districts
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'advert_type_select' => 'required|exists:advertisement_types,id|int',
            'input_advert_title' => 'required|string|max:50',
            'input_advert_content' => 'required|string|max:5000',
            'input_hour_rate' => 'required|numeric|min:0',
            'input_min_child_age' => 'required|numeric|min:0|max:18',
            'input_max_child_age' => 'required|numeric|min:0|max:18|gte:input_min_child_age',
            'input_number_of_childs' => 'required|numeric|min:0|max:10',
            'input_advert_from' => 'required|date|after_or_equal:now',
            'input_advert_to' => 'required|date|after:input_advert_from',
            'input_supervise_from' => 'required|date|after_or_equal:now',
            'input_supervise_to' => 'required|date|after:input_supervise_from'

        ]);
        
        // dd($request);

        auth()->user()->advertisements()->create([
            'id_advertisement_type' => $request->advert_type_select,
            'title' => $request->input_advert_title,
            'content' => $request->input_advert_content,
            'hour_rate' => $request->input_hour_rate,
            'age_min' => $request->input_min_child_age,
            'age_max' => $request->input_max_child_age,
            'child_num' => $request->input_number_of_childs,
            'date_from' => $request->input_advert_from,
            'date_to' => $request->input_advert_to,
            'supervise_from' => $request->input_supervise_from,
            'supervise_to' => $request->input_supervise_to
        ]);

        return redirect()->route('show_advert');
    }

    public function show()
    {
        $adverts = auth()->user()->advertisements()->get();
        return view('advertisements.show', [
            'adverts' => $adverts
        ]);
    }

    public function delete(Advertisement $advert)
    {
        $advert->delete();

        return back();
    }

    public function getVoivodeships($id)
    {
        $voivoideships['data'] = Voivodeship::get()->where('id_country', $id)->sortBy('voivodeship_name');

        echo json_encode($voivoideships);
        exit;
    }

    public function getCities($id)
    {
        $cities['data'] = City::get()->where('id_voivodeship', $id)->sortBy('city_name');

        echo json_encode($cities);
        exit;
    }

    public function getDistricts ($id)
    {
        $districts['data'] = District::get()->where('id_city', $id)->sortBy('district_name');

        echo json_encode($districts);
        exit;
    }
}