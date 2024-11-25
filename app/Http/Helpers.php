<?php
use App\Models\Conversation;
use App\Models\BusinessSetting;
use App\Models\Address;
use App\Models\Message;
use App\Models\SeoSetting;
use App\Models\OtpConfiguration;
use App\Models\Upload;
use App\Models\Translation;
use App\Models\City;
use App\Utility\CategoryUtility;
use App\Utility\MimoUtility;
use Twilio\Rest\Client;
use ConvertApi\ConvertApi;
use  App\Models\User;
use Spatie\Browsershot\Browsershot;



//highlights the selected navigation on admin panel
if (! function_exists('areActiveRoutes')) {
    function areActiveRoutes(Array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }

    }
}

//highlights the selected navigation on frontend
if (! function_exists('areActiveRoutesHome')) {
    function areActiveRoutesHome(Array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }

    }
}

//highlights the selected navigation on frontend
if (! function_exists('default_language')) {
    function default_language()
    {
        return env("DEFAULT_LANGUAGE");
    }
}

/**
 * Save JSON File
 * @return Response
 */
if (! function_exists('convert_to_usd')) {
    function convert_to_usd($amount) {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if($business_settings!=null){
            $currency = Currency::find($business_settings->value);
            return (floatval($amount) / floatval($currency->exchange_rate)) * Currency::where('code', 'USD')->first()->exchange_rate;
        }
    }
}

if (! function_exists('convert_to_kes')) {
    function convert_to_kes($amount) {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if($business_settings!=null){
            $currency = Currency::find($business_settings->value);
            return (floatval($amount) / floatval($currency->exchange_rate)) * Currency::where('code', 'KES')->first()->exchange_rate;
        }
    }
}








function translate($key, $lang = null){

    if($lang == null){
        $lang = App::getLocale();
    }
    // Artisan::call('optimize:clear');

//    $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));

    $translations_default = Cache::rememberForever('translations-'.env('DEFAULT_LANGUAGE', 'ar'), function ()  {
        return Translation::where('lang', env('DEFAULT_LANGUAGE', 'ar'))->pluck('lang_value', 'lang_key')->toArray();
    });


    if(!isset($translations_default[$key]) && $key != NULL && $key !=[] && $key !=''){

        $translation_def = new Translation;
        $translation_def->lang =env('DEFAULT_LANGUAGE', 'ar');
        $translation_def->lang_key = $key;
        $translation_def->lang_value = $key;
        $translation_def->save();
        Cache::forget('translations-'.env('DEFAULT_LANGUAGE', 'ar'));
    }

    $translation_locale = Cache::rememberForever('translations-'.$lang, function () use ($lang) {
        return Translation::where('lang', $lang)->pluck('lang_value', 'lang_key')->toArray();
    });



    //Check for session lang


    //   $translation_locale = Translation::where('lang_key', $key)->where('lang', $lang)->first();
    // if($translation_locale != null && $translation_locale->lang_value != null){
    //     return $translation_locale->lang_value;
    // }
    if(isset($translation_locale[$key])){
        return $translation_locale[$key];
    }
    elseif(isset($translations_default[$key])){
        return $translations_default[$key];
    }
    else{
        return $key;
    }
}



if (!function_exists('api_asset')) {
    function api_asset($id)
    {
        if (($asset = \App\Models\Upload::find($id)) != null) {
            return $asset->file_name;
        }
        return "";
    }
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {


    function uploaded_asset($id)
    {

        $asset = Cache::rememberForever('uploads', function ()  {
            return Upload::pluck( 'file_name','id')->toArray();
        });

        if (in_array($id,array_keys ($asset))) {
            return my_asset($asset[$id]);
        }
        return null;
    }
}

if (! function_exists('my_asset')) {
    /**zzzz
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function my_asset($path, $secure = null)
    {
        $path=File::exists(public_path($path))?$path:'assets_v2/No-Image-Placeholder.svg';
        if(env('FILESYSTEM_DRIVER') == 's3'){
            return Storage::disk('s3')->url($path);
        }
        elseif(env('FILESYSTEM_DRIVER_2') == 'local'){
            return app('url')->asset($path, $secure);
        }
        else {
            return app('url')->asset('/public/'.$path, $secure);
        }
    }
}

if (! function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        $path=File::exists(public_path($path))?$path:'assets_v2/No-Image-Placeholder.svg';

        if (env('FILESYSTEM_DRIVER_2') == 'local') {

            return app('url')->asset($path, $secure);
        } else {
            return app('url')->asset('/public/'.$path, $secure);

        }

    }
}



if (!function_exists('isHttps')) {
    function isHttps()
    {
        return !empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS']);
    }
}

if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = (isHttps() ? "https://" : "http://").$_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}


if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if(env('FILESYSTEM_DRIVER') == 's3'){
            return env('AWS_URL').'/';
        }
        else {
            return getBaseURL();
        }
    }
}


if (! function_exists('isUnique')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function isUnique($email)
    {
        $user = \App\User::where('email', $email)->first();

        if($user == null) {
            return '1'; // $user = null means we did not get any match with the email provided by the user inside the database
        } else {
            return '0';
        }
    }
}

if (!function_exists('set_setting')) {
    function set_setting($key,$value)
    {
        $settings = BusinessSetting::where('type', $key)->first();
        if(!empty($settings)){
            $settings->type=$key;
            $settings->value=$value;
            $settings->save();
        }else{
            $settings =new BusinessSetting();
            $settings->type=$key;
            $settings->value=$value;
            $settings->save();
        }

        return $settings->value;
    }
}
if (!function_exists('get_setting')) {
    function get_setting($key, $default = null)
    {
        $settings = Cache::remember('business_settings', 86400, function(){
            return BusinessSetting::all();
        });

        $setting = $settings->where('type', $key)->first();
        return $setting == null ? $default : $setting->value;
    }
}
if (!function_exists('get_seo_h1_setting')) {
    function
    get_seo_h1_setting($key, $default = null)
    {
//        $settings = Cache::remember('seo_setting', 86400, function(){
//            return SeoSetting::all();
//        });
        if(App::getLocale()=="en"){
            $setting = SeoSetting::where('current_url', urlencode($key))->first();
        }else{
            $setting = SeoSetting::where('current_url', $key)->first();
        }
        if($setting == null){
            $setting = SeoSetting::where('current_url', urlencode($key))->first();
        }
        return $setting == null ? $default : $setting->meta_h1;
    }
}
if (!function_exists('get_seo_title_setting')) {
    function get_seo_title_setting($key, $default = null)
    {
//        $settings = Cache::remember('seo_setting', 86400, function(){
//            return SeoSetting::all();
//        });
        if(App::getLocale()=="en"){
            $setting = SeoSetting::where('current_url', urlencode($key))->first();
        }else{
            $setting = SeoSetting::where('current_url', $key)->first();
        }
        if($setting == null){
            $setting = SeoSetting::where('current_url', urlencode($key))->first();
        }
        return $setting == null ? $default : $setting->meta_title;
    }
}
if (!function_exists('get_seo_keys_setting')) {
    function get_seo_keys_setting($key, $default = null)
    {
        if(App::getLocale()=="en"){
            $setting = SeoSetting::where('current_url', urlencode($key))->first();
        }else{
            $setting = SeoSetting::where('current_url', $key)->first();
        }
        if($setting == null){
            $setting = SeoSetting::where('current_url', urlencode($key))->first();
        }
        return $setting == null ? $default : $setting->meta_keywords;
    }
}
if (!function_exists('get_seo_description_setting')) {
    function get_seo_description_setting($key, $default = null)
    {
        if(App::getLocale()=="en"){
            $setting = SeoSetting::where('current_url', urlencode($key))->first();
        }else{
            $setting = SeoSetting::where('current_url', $key)->first();
        }
        if($setting == null){
            $setting = SeoSetting::where('current_url', urlencode($key))->first();
        }
        return $setting == null ? $default : $setting->meta_description;
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        if (Auth::check() && (Auth::user()->user_type == 'admin' || Auth::user()->user_type == 'staff')) {
            return true;
        }
        return false;
    }
}


if (!function_exists('isCustomer')) {
    function isCustomer()
    {
        if (Auth::check() && Auth::user()->user_type == 'customer') {
            return true;
        }
        return false;
    }
}



if (!function_exists('get_images')) {
    function get_images($given_ids, $with_trashed = false)
    {
        $ids =( is_array($given_ids) ? $given_ids
            : is_null($given_ids)) ? [] : explode(",", $given_ids);

        return $with_trashed
            ? Upload::withTrashed()->whereIn('id', $ids)->get()
            : Upload::whereIn('id', $ids)->get();
    }
}

//for api
if (!function_exists('get_images_path')) {
    function get_images_path($given_ids, $with_trashed = false)
    {
        $paths = [];
        $images = get_images($given_ids, $with_trashed);
        if (!$images->isEmpty()) {
            foreach ($images as $image) {
                $paths[] = !is_null($image) ? $image->file_name :"";
            }
        }

        return $paths;

    }
}





function sendSmsMassage($number,$msg)
{
    $megs = new Message();
    $megs->user_id = User::where('phone',$number)->first()->id;
    $megs->from_user = auth::user()->id??null;
    $megs->message = $msg;
    $megs->save();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://www.msegat.com/gw/sendsms.php");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);

    $fields = <<<EOT
        {
  
        }
EOT;

    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_HTTPHEADER,  [
    ]);
    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close($ch);
}

function convert($string) {
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١','٠'];

    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

    return $englishNumbersOnly;
}



?>