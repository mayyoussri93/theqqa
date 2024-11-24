<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait CentralTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */

    public function getUserCentral($user_phone)
    {
        if($user_phone== "ا.منار  الشمري<110>"){
            $user_id=74;
        }elseif($user_phone== "ا.اسماء الحربي<111>"){
            $user_id=82;
        }elseif($user_phone== "ا.عمشاء الشمري<112>"){
            $user_id=1731;
        }elseif($user_phone==  "ا.رانيا  شمسان<114>"){
            $user_id=2344;
        }elseif($user_phone== "ا.سحايب  العتيبي<115>"){
            $user_id=3511;
        }elseif($user_phone==  "ا.الكليبي سكرتير تنفيذي<102>") {
            $user_id=4781;
        }else{
            if(is_numeric($user_phone)){
                $check= check_contract_central_data($user_phone);
                if($check == null) {
                    $user_id = $user_phone;
                }else{
                    if(isset($check['business'])||isset($check['mobile'])) {
                        $mob = $check['business'] ?? $check['mobile'];
                    }else{
                        $mob='';
                    }
                    $user_id=$check['contact_name'].' '. $mob;
                }}
            else{
                $user_id = $user_phone;

            }

        }
        return $user_id;
    }

    public function getUserCentralData($user_phone)
    {
        if($user_phone== "ا.منار  الشمري<110>"){
            $user_data=null;
        }elseif($user_phone== "ا.اسماء الحربي<111>"){
            $user_data=null;
        }elseif($user_phone== "ا.عمشاء الشمري<112>"){
            $user_data=null;
        }elseif($user_phone==  "ا.رانيا  شمسان<114>"){
            $user_data=null;
        }elseif($user_phone== "ا.سحايب  العتيبي<115>"){
            $user_data=null;

        }elseif($user_phone==  "ا.الكليبي سكرتير تنفيذي<102>") {
            $user_data=null;
        }else{
            if(is_numeric($user_phone)){
                $check= check_contract_central_data($user_phone);
                if($check == null) {
                    $user_data = null;
                }else{

                    $user_data=$check;
                }}
            else{
                $user_data = null;

            }

        }
        return $user_data;
    }

}