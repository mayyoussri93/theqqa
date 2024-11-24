<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class MusanedController extends Controller
{

    public function index()
    {
        return view('backend.SettingManagement.other_pages.musaned.index');



    }

    //updates the policy pages
    public function store(Request $request){


        $musaned_title = BusinessSetting::where('type', 'musaned_title')->first();
        if(!$musaned_title) {
            $musaned_title = new BusinessSetting;
            $musaned_title->type = 'musaned_title';
        }

        $musaned_title->value = '';
        if ($request->musaned_title) {
            $musaned_title->value = $request->musaned_title;
        }

        $musaned_title->save();

//=====================================================================
        $musaned_description = BusinessSetting::where('type', 'musaned_description')->first();
        if(!$musaned_description) {
            $musaned_description = new BusinessSetting;
            $musaned_description->type = 'musaned_description';
        }

        $musaned_description->value = '';
        if ($request->musaned_description) {
            $musaned_description->value = $request->musaned_description;
        }

        $musaned_description->save();
 //======================================================================
        $musaned_logo = BusinessSetting::where('type', 'musaned_logo')->first();
        if(!$musaned_logo) {
            $musaned_logo = new BusinessSetting;
            $musaned_logo->type = 'musaned_logo';
        }

        $musaned_logo->value = '';
        if ($request->musaned_logo) {
            $musaned_logo->value = $request->musaned_logo;
        }

        $musaned_logo->save();
 //==================================================================
        $musaned_image = BusinessSetting::where('type', 'musaned_image')->first();
        if(!$musaned_image) {
            $musaned_image = new BusinessSetting;
            $musaned_image->type = 'musaned_image';
        }

        $musaned_image->value = '';
        if ($request->musaned_image) {
            $musaned_image->value = $request->musaned_image;
        }

        $musaned_image->save();
        //==================================================================
        $musaned_fees_title = BusinessSetting::where('type', 'musaned_fees_title')->first();
        if(!$musaned_fees_title) {
            $musaned_fees_title = new BusinessSetting;
            $musaned_fees_title->type = 'musaned_fees_title';
        }

        $musaned_fees_title->value = '';
        if ($request->musaned_fees_title) {
            $musaned_fees_title->value = $request->musaned_fees_title;
        }

        $musaned_fees_title->save();
        //==================================================================
        $musaned_fees_description = BusinessSetting::where('type', 'musaned_fees_description')->first();
        if(!$musaned_fees_description) {
            $musaned_fees_description = new BusinessSetting;
            $musaned_fees_description->type = 'musaned_fees_description';
        }

        $musaned_fees_description->value = '';
        if ($request->musaned_fees_description) {
            $musaned_fees_description->value = $request->musaned_fees_description;
        }

        $musaned_fees_description->save();
        //==================================================================


                $musaned_fees_logo = BusinessSetting::where('type', 'musaned_fees_logo')->first();
        if(!$musaned_fees_logo) {
            $musaned_fees_logo = new BusinessSetting;
            $musaned_fees_logo->type = 'musaned_fees_logo';
        }

        $musaned_fees_logo->value = '';
        if ($request->musaned_fees_logo) {
            $musaned_fees_logo->value = $request->musaned_fees_logo;
        }

        $musaned_fees_logo->save();

        //==================================================================


        $musaned_apps_title = BusinessSetting::where('type', 'musaned_apps_title')->first();
        if(!$musaned_apps_title) {
            $musaned_apps_title = new BusinessSetting;
            $musaned_apps_title->type = 'musaned_apps_title';
        }

        $musaned_apps_title->value = '';
        if ($request->musaned_apps_title) {
            $musaned_apps_title->value = $request->musaned_apps_title;
        }

        $musaned_apps_title->save();
//===============================================================================


        $musaned_apps_description = BusinessSetting::where('type', 'musaned_apps_description')->first();
        if(!$musaned_apps_description) {
            $musaned_apps_description = new BusinessSetting;
            $musaned_apps_description->type = 'musaned_apps_description';
        }

        $musaned_apps_description->value = '';
        if ($request->musaned_apps_description) {
            $musaned_apps_description->value = $request->musaned_apps_description;
        }

        $musaned_apps_description->save();
        //===============================================================================


        $musaned_android_link = BusinessSetting::where('type', 'musaned_android_link')->first();
        if(!$musaned_android_link) {
            $musaned_android_link = new BusinessSetting;
            $musaned_android_link->type = 'musaned_android_link';
        }

        $musaned_android_link->value = '';
        if ($request->musaned_android_link) {
            $musaned_android_link->value = $request->musaned_android_link;
        }

        $musaned_android_link->save();

        //===============================================================================


        $musaned_apple_link = BusinessSetting::where('type', 'musaned_apple_link')->first();
        if(!$musaned_apple_link) {
            $musaned_apple_link = new BusinessSetting;
            $musaned_apple_link->type = 'musaned_apple_link';
        }

        $musaned_apple_link->value = '';
        if ($request->musaned_apple_link) {
            $musaned_apple_link->value = $request->musaned_apple_link;
        }

        $musaned_apple_link->save();

//==================================================

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
        return redirect()->route('musaned.view');
    }
}
