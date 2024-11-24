<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function ourStaff(){
        $staffs = Staff::all();
        return view('frontend.staff',['staffs'=>$staffs]);
    }

}
