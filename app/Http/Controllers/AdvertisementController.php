<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\Voivodeship;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Skill;
use App\Models\User;
use Carbon\Carbon;
use PHPUnit\Framework\Constraint\Count;

class AdvertisementController extends Controller
{
    public function add()
    {
        $countries = Country::all()->sortBy('country_name');
        $voivodeships = Voivodeship::all()->sortBy('voivodeship_name');
        $cities = City::all()->sortBy('city_name');
        $districts = District::all()->sortBy('district_name');
        $skills = Skill::all()->sortBy('skill_name');


        return view('advertisements.add', [
            'countries' => $countries,
            'voivodeships' => $voivodeships,
            'cities' => $cities,
            'districts' => $districts,
            'skills' => $skills
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'advert_type_select' => 'required|exists:advertisement_types,id|int',
            'input_advert_title' => 'required|string|max:50',
            'input_advert_content' => 'required|string|max:5000',
            'input_hour_rate' => 'required|numeric|min:0|max:100',
            'input_min_child_age' => 'required|numeric|min:0|max:18',
            'input_max_child_age' => 'required|numeric|min:0|max:18|gte:input_min_child_age',
            'input_number_of_childs' => 'required|numeric|min:0|max:10',
            'input_advert_from' => 'required|date|after_or_equal:-5 minutes',
            'input_advert_to' => 'required|date|after:input_advert_from',
            'input_supervise_from' => 'required|date|after_or_equal:-5 minutes',
            'input_supervise_to' => 'required|date|after:input_supervise_from',
            'input_country' => 'required|exists:countries,id',
            'input_voivodeship' => 'required|exists:voivodeships,id',
            'input_city' => 'required|exists:cities,id',
            'input_district' => 'required|exists:districts,id',
            'input_skill' => 'required|array|exists:skills,id'
        ]);

        $advert_id = auth()->user()->advertisements()->create([
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
        ])->id;

        $district_id = District::find($request->input_district);
        $district_id->advertisements()->attach($advert_id);

        foreach ($request->input_skill as $key => $value) {
            $skill_id = Skill::find($value);
            $skill_id->advertisements()->attach($advert_id, ['is_deleted' => 0]);
        }

        return redirect()->route('show_advert');
    }

    public function show()
    {
        $adverts = auth()->user()->advertisements()->orderByDesc('created_at')->paginate(5);
        return view('advertisements.show', [
            'adverts' => $adverts
        ]);
    }

    public function showSingle(Advertisement $advert)
    {
        $user = User::find($advert->id_user);
        $district = $advert->districts[0];
        $city = City::find($district->id_city);
        $skills = $advert->skills;

        return view('advertisements.showSingle', [
            'advert' => $advert,
            'user' => $user,
            'district' => $district,
            'city' => $city,
            'skills' => $skills
        ]);
    }

    public function delete(Advertisement $advert)
    {
        $advert->districts()->detach();
        $advert->skills()->detach();
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

    public function editShow(Advertisement $advert)
    {
        $user = User::find($advert->id_user);
        if(auth()->user() == $user)
        {
            $user = User::find($advert->id_user);
            $district_choosen = $advert->districts[0];
            $city_choosen = City::find($district_choosen->id_city);
            $voivodeship_choosen = Voivodeship::find($city_choosen->id_voivodeship);
            $country_choosen = Country::find($voivodeship_choosen->id_country);
            $skills_choosen = $advert->skills;
            $countries = Country::all()->sortBy('country_name');
            $voivodeships = Voivodeship::all()->sortBy('voivodeship_name');
            $cities = City::all()->sortBy('city_name');
            $districts = District::all()->sortBy('district_name');
            $skills = Skill::all()->sortBy('skill_name');

            return view('advertisements.edit', [
                'advert' => $advert,
                'user' => $user,
                'district_choosen' => $district_choosen,
                'city_choosen' => $city_choosen,
                'voivodeship_choosen' => $voivodeship_choosen,
                'country_choosen' => $country_choosen,
                'skills_choosen' => $skills_choosen,
                'countries' => $countries,
                'voivodeships' =>$voivodeships,
                'cities' => $cities,
                'districts' => $districts,
                'skills' => $skills
            ]);
        }
        else
        {
            return view('advertisements.edit', [
                'error' => "Nie możesz edytować nie swoich ogłoszeń"
            ]);
        }
        
    }

    public function editSave(Request $request, Advertisement $advert)
    {
        $this->validate($request, [
            'advert_type_select' => 'required|exists:advertisement_types,id|int',
            'input_advert_title' => 'required|string|max:50',
            'input_advert_content' => 'required|string|max:5000',
            'input_hour_rate' => 'required|numeric|min:0|max:100',
            'input_min_child_age' => 'required|numeric|min:0|max:18',
            'input_max_child_age' => 'required|numeric|min:0|max:18|gte:input_min_child_age',
            'input_number_of_childs' => 'required|numeric|min:0|max:10',
            'input_advert_from' => 'required|date',
            'input_advert_to' => 'required|date|after:input_advert_from',
            'input_supervise_from' => 'required|date',
            'input_supervise_to' => 'required|date|after:input_supervise_from',
            'input_country' => 'required|exists:countries,id',
            'input_voivodeship' => 'required|exists:voivodeships,id',
            'input_city' => 'required|exists:cities,id',
            'input_district' => 'required|exists:districts,id',
            'input_skill' => 'required|array|exists:skills,id'
        ]);

        Advertisement::find($advert->id)->update([
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

        $advert->districts()->detach();
        $advert->skills()->detach();

        $district_id = District::find($request->input_district);
        $district_id->advertisements()->attach($advert->id);

        foreach ($request->input_skill as $key => $value) {
            $skill_id = Skill::find($value);
            $skill_id->advertisements()->attach($advert->id, ['is_deleted' => 0]);
        }

        return redirect()->route('show_advert')->with('status', 'true');
    }
}
