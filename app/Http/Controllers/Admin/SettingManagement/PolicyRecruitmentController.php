<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use App\Models\BusinessSetting;


class PolicyRecruitmentController extends Controller
{

    public function index()
    {
        return view('backend.policy_recruitment.index');



    }

    //updates the policy pages
    public function store(Request $request){


        $policy_recruitment_title = BusinessSetting::where('type', 'policy_recruitment_title')->first();
        if(!$policy_recruitment_title) {
            $policy_recruitment_title = new BusinessSetting;
            $policy_recruitment_title->type = 'policy_recruitment_title';
        }

        $policy_recruitment_title->value = '';
        if ($request->policy_recruitment_title) {
            $policy_recruitment_title->value = $request->policy_recruitment_title;
        }

        $policy_recruitment_title->save();




        $policy_recruitment_description = BusinessSetting::where('type', 'policy_recruitment_description')->first();
        if(!$policy_recruitment_description) {
            $policy_recruitment_description = new BusinessSetting;
            $policy_recruitment_description->type = 'policy_recruitment_description';
        }

        $policy_recruitment_description->value = 'policy_recruitment_description';
        if ($request->policy_recruitment_description) {
            $policy_recruitment_description->value = $request->policy_recruitment_description;
        }

        $policy_recruitment_description->save();



        foreach ($request->types as $key => $type) {
            if($type == 'site_name'){
                $this->overWriteEnvFile('APP_NAME', $request[$type]);
            }
            if($type == 'timezone'){
                $this->overWriteEnvFile('APP_TIMEZONE', $request[$type]);
            }
            else {
                $business_settings = BusinessSetting::where('type', $type)->first();
                if($business_settings!=null){

                    if(gettype($request[$type]) == 'array'){
                        $business_settings->value = json_encode($request[$type]);
                    }
                    else {
                        $business_settings->value = $request[$type];
                    }
                    $business_settings->save();
                }
                else{
                    $business_settings = new BusinessSetting;
                    $business_settings->type = $type;
                    if(gettype($request[$type]) == 'array'){
                        $business_settings->value = json_encode($request[$type]);
                    }
                    else {
                        $business_settings->value = $request[$type];
                    }
                    $business_settings->save();
                }
            }
        }
        Artisan::call('cache:clear');

        flash("تم التحديث بنجاح")->success();
        return redirect()->route('website.other_pages');

    }
}