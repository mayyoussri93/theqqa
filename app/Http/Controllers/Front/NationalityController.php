<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Nationality;
use Illuminate\Http\Request;
use App\Models\Country;

class NationalityController extends Controller
{

    public function getCountries(){
        $countries = Nationality::all();
        return view('frontend.countries', compact('countries'));
    }
}
