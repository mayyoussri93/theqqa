<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use Artisan;
use CoreComponentRepository;
use Illuminate\Http\Request;

class BusinessSettingsController extends Controller
{


    public function smtp_settings(Request $request)
    {
//        CoreComponentRepository::instantiateShopRepository();
        return view('backend.SettingManagement.setup_configurations.smtp_settings');
    }




    public function env_key_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
                $this->overWriteEnvFile($type, $request[$type]);
        }
        Artisan::call('optimize:clear');

        flash(translate("تم تحديث الإعدادات بنجاح"))->success();
        return back();
    }

    /**
     * overWrite the Env File values.
     * @param  String type
     * @param  String value
     * @return \Illuminate\Http\Response
     */
    public function overWriteEnvFile($type, $val)
    {
        if(env('DEMO_MODE') != 'On'){
            $path = base_path('.env');
            if (file_exists($path)) {
                $val = '"'.trim($val).'"';
                if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                    file_put_contents($path, str_replace(
                        $type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)
                    ));
                }
                else{
                    file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
                }
            }
        }
    }

    public function update(Request $request)
    {

        foreach ($request->types as $key => $type) {
            if($type == 'site_name'){
                $this->overWriteEnvFile('APP_NAME', $request[$type]);
            }
            elseif($type=='meta_keywords'){
                $business_settings1 = BusinessSetting::where('type', $type)->first();
                if($business_settings1!=null){
                    $meta_keywords = array();
                    if($request[$type][0] != null){
                        foreach (json_decode($request[$type][0]) as $key => $tag) {
                            array_push($meta_keywords, $tag->value);
                        }
                    }
                    $business_settings1->value  = implode(',', $meta_keywords);

                    $business_settings1->save();
                }
                else{
                    $business_settings1 = new BusinessSetting;
                    $business_settings1->type = $type;
                    $business_settings1 = BusinessSetting::where('type', $type)->first();

                        $meta_keywords = array();
                        if($request[$type][0] != null){
                            foreach (json_decode($request[$type][0]) as $key => $tag) {
                                array_push($meta_keywords, $tag->value);
                            }
                        }
                        $business_settings1->value  = implode(',', $meta_keywords);

                        $business_settings1->save();
                }
            }
            elseif($type == 'timezone'){
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

        flash(translate("تم تحديث الإعدادات بنجاح"))->success();
        return back();
    }

    public function updateActivationSettings(Request $request)
    {
        $env_changes = ['FORCE_HTTPS', 'FILESYSTEM_DRIVER'];
        if (in_array($request->type, $env_changes)) {

            return $this->updateActivationSettingsInEnv($request);
        }

        $business_settings = BusinessSetting::where('type', $request->type)->first();
        if($business_settings!=null){
            if ($request->type == 'maintenance_mode' && $request->value == '1') {
                if(env('DEMO_MODE') != 'On'){
                    Artisan::call('down');
                }
            }
            elseif ($request->type == 'maintenance_mode' && $request->value == '0') {
                if(env('DEMO_MODE') != 'On') {
                    Artisan::call('up');
                }
            }
            $business_settings->value = $request->value;
            $business_settings->save();
        }
        else{
            $business_settings = new BusinessSetting;
            $business_settings->type = $request->type;
            $business_settings->value = $request->value;
            $business_settings->save();
        }

        Artisan::call('cache:clear');
        return '1';
    }

    public function updateActivationSettingsInEnv($request)
    {
        if ($request->type == 'FORCE_HTTPS' && $request->value == '1') {
            $this->overWriteEnvFile($request->type, 'On');

            if(strpos(env('APP_URL'), 'http:') !== FALSE) {
                $this->overWriteEnvFile('APP_URL', str_replace("http:", "https:", env('APP_URL')));
            }

        }
        elseif ($request->type == 'FORCE_HTTPS' && $request->value == '0') {
            $this->overWriteEnvFile($request->type, 'Off');
            if(strpos(env('APP_URL'), 'https:') !== FALSE) {
                $this->overWriteEnvFile('APP_URL', str_replace("https:", "http:", env('APP_URL')));
            }

        }
        elseif ($request->type == 'FILESYSTEM_DRIVER' && $request->value == '1') {
            $this->overWriteEnvFile($request->type, 's3');
        }
        elseif ($request->type == 'FILESYSTEM_DRIVER' && $request->value == '0') {
            $this->overWriteEnvFile($request->type, 'local');
        }

        return '1';
    }

}
