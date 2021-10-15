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
            
        ]);
        dd($request);
    }
}
