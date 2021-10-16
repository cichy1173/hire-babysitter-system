<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function add()
    {
        return view('advertisements.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'input_advert_title' => 'required'
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
    }
}
