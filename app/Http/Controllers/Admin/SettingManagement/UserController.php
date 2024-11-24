<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserInfo($idOfUser)
    {
        $dataOfUser = User::findorFail($idOfUser)->toArray();
        return response()->json($dataOfUser);
    }
    public function check_phone(Request $request)
    {
        $phoneUser=$request->guarantor_phone;
        $dataOfUser = User::where('phone',$phoneUser)->count();
        if($dataOfUser != 0){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }


}
