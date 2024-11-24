<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaaroufaController extends Controller
{
    //
    public function showServiceDetails(Request  $request) {
        return view("frontend.maaroufa_service");
    }
}
