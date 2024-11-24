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

/*==================== السنترال  ==================*/

if (!function_exists('get_central_setting')) {
    function get_central_setting($key, $default = null)
    {
        $setting = BusinessSetting::where('type', $key)->first();
        return $setting?$setting->value:null;
    }
}
function central_access_token()
{

    $token_url = 'https://rawafdnajd.ras.yeastar.com/openapi/v1.0/get_token';
    $user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64)';
    $login_data = '  {
	"username": "dP3hgJ2XO7a1vQh1uQMXJapM1IpXm4ty",
	"password": "7nCGiygHI3tY6yTjVoYSpXJ2cJiyq8aB"
   }';

    $curl = curl_init($token_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $login_data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

    $json_response = curl_exec($curl);
    $array_response =json_decode($json_response, true);
    curl_close($curl);

    if(!empty($array_response)&&$array_response['errcode']==0){
        set_setting('central_access_token',$array_response['access_token']);
        set_setting('refresh_central_access_token',$array_response['refresh_token']);



    }else{
        central_refresh_access_token();
    }


}
function central_refresh_access_token()
{


    $token_url = 'https://rawafdnajd.ras.yeastar.com/openapi/v1.0/refresh_token';
    $login_data = '{
    "refresh_token":"'.get_central_setting("central_access_token").'"
}';
    $curl = curl_init($token_url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER,array("Content-type: application/json"));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $login_data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);


    $json_response = curl_exec($curl);
    $array_response =json_decode($json_response, true);

    curl_close($curl);
    if(!empty($array_response)&&$array_response['errcode']==0){

        set_setting('central_access_token',$array_response['access_token']);
        set_setting('refresh_central_access_token',$array_response['refresh_token']);

                }else{
                    central_access_token();

                }




}
function getUserCentral($user_phone)
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
        $user_id=$user_phone;
    }
    return $user_id;


}
function central_data()
{

//    try {
    if(!empty(get_central_setting("central_access_token"))) {

        $access_token=get_central_setting("central_access_token");

        $start_date= Carbon\Carbon::now()->subMonth()->format('d/m/Y');
        $end_date= Carbon\Carbon::now()->endOfMonth()->format('d/m/Y');


        $token_url="https://rawafdnajd.ras.yeastar.com/openapi/v1.0/cdr/search?start_time=".$start_date."%2012:00:00%20AM&end_time=".$end_date."%2011:59:59%20PM&access_token=".$access_token;
        $curl = curl_init($token_url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

        $json_response2 = curl_exec($curl);
        $array_response2 = json_decode($json_response2, true);
if(!empty($array_response2)&&$array_response2['errcode']==10004){
   // session()->forget('central_access_token');
    central_refresh_access_token();
    central_data();
}elseif($array_response2== null){
    central_access_token();
    central_data();
}
    else{
    return $array_response2['data'] ;
}

    }else{
        central_access_token();
        central_data();

    }
//    } catch (\Exception $e) {
//        return null;
//
//    }
}
function check_contract_central_data($mobile)
{
//    try {
    if(!empty(get_central_setting("central_access_token"))) {
        $access_token=get_central_setting("central_access_token");
        $search_value ="$mobile";
        $token_url="https://rawafdnajd.ras.yeastar.com/openapi/v1.0/company_contact/search?search_value=".$search_value."&access_token=".$access_token;
        $curl = curl_init($token_url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

        $json_response2 = curl_exec($curl);
        $array_response2 = json_decode($json_response2, true);
        if(!empty($array_response2)&&$array_response2['errcode']==10004){
//            session()->forget('central_access_token');
            central_refresh_access_token();
            check_contract_central_data($mobile);
        }elseif($array_response2== null){
            central_access_token();
            check_contract_central_data($mobile);
        }
        else{
            if($array_response2['total_number']==0){
                return null;
            }else{
                $count=count($array_response2['data']);
                return $array_response2['data'][$count-1] ;
            }

        }


    }else{
        central_access_token();
        check_contract_central_data($mobile);

    }
//    } catch (\Exception $e) {
//        return null;
//
//    }
}
function add_contract_central_data($first_name,$mobile,$details,$phone_book)
{

//    try {
    if(!empty(get_central_setting("central_access_token"))) {

        $access_token=get_central_setting("central_access_token");


        if ($phone_book==null){
            $login_data = '{"first_name": "'.$first_name.'","remark": "'.$details.'","number_list": [{ "num_type": "business_number","number": "'.$mobile.'"}]}';
        }else{
            $login_data = '  {
	    "first_name": "'.$first_name.'",
	      "remark": "'.$details.'",
	       "phonebook_id_list": [
        '.$phone_book.'
    ],
	      "number_list": [
        {       
            "num_type": "business_number",
            "number": "'.$mobile.'"
        }
    ]
   }';
        }


        $token_url="https://rawafdnajd.ras.yeastar.com/openapi/v1.0/company_contact/create?access_token=".$access_token;

        $curl = curl_init($token_url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $login_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

        $json_response2 = curl_exec($curl);
        $array_response2 = json_decode($json_response2, true);
        if(!empty($array_response2)&&$array_response2['errcode']==10004){
//            session()->forget('central_access_token');
            central_refresh_access_token();
            add_contract_central_data($first_name,$mobile,$details,$phone_book);
        }elseif($array_response2== null){
            central_access_token();
            add_contract_central_data($first_name,$mobile,$details,$phone_book);
        }
        else{
            return $array_response2['id'] ;
        }


    }else{
        central_access_token();
        add_contract_central_data($first_name,$mobile,$details,$phone_book);

    }
//    } catch (\Exception $e) {
//        return null;
//
//    }
}
function update_contract_central_data($first_name,$mobile,$id,$details,$phone_book)
{

//    try {
    if(!empty(get_central_setting("central_access_token"))) {

        $access_token=get_central_setting("central_access_token");

        if ($phone_book==null){
            $login_data = '{"id": '.$id.',"first_name": "'.$first_name.'","remark": "'.$details.'","number_list": [{ "num_type": "business_number","number": "'.$mobile.'"}]}';
        }else{
            $login_data = '  {
            "id": '.$id.',
	    "first_name": "'.$first_name.'",
	      "remark": "'.$details.'",
	       "phonebook_id_list": [
        '.$phone_book.'
    ],
	      "number_list": [
        {       
            "num_type": "business_number",
            "number": "'.$mobile.'"
        }
    ]
   }';
        }
        $token_url="https://rawafdnajd.ras.yeastar.com/openapi/v1.0/company_contact/update?access_token=".$access_token;

        $curl = curl_init($token_url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $login_data);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

        $json_response2 = curl_exec($curl);
        $array_response2 = json_decode($json_response2, true);
        if(!empty($array_response2)&&$array_response2['errcode']==10004){
            session()->forget('central_access_token');
            central_refresh_access_token();
            update_contract_central_data($first_name,$mobile,$id,$details,$phone_book);
        }elseif($array_response2== null){
            central_access_token();
            update_contract_central_data($first_name,$mobile,$id,$details,$phone_book);

        }
        elseif($array_response2['errcode']== 40002){
            update_contract_central_data($first_name,$mobile,$id,$details,$phone_book);

        }
        else{
            return   true ;
        }


    }else{
        central_access_token();
        update_contract_central_data($first_name,$mobile,$id,$details,$phone_book);

    }
//    } catch (\Exception $e) {
//        return null;
//
//    }
}
/*===============================================*/
/*==================== الفواتير  ==================*/
function list_invoices_data($url)
{
        $access_token=get_central_setting("central_access_token");
        $token_url="https://ashry9202023.daftra.com/".$url;
        $curl = curl_init($token_url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'APIKEY: 9c3f8ae87c0082a1e8e6c1231f0769ed8fb0bb38' ,
        'accept:application/json'
    ));

        $json_response = curl_exec($curl);
        $array_response = json_decode($json_response, true);

    if(!empty($array_response)&&$array_response['code']==200) {

        return ['data'=>$array_response['data'],'next'=>$array_response['pagination']['next'],'page_count'=>$array_response['pagination']['page_count'],'page'=>$array_response['pagination']['page']] ;
    }else{
            return null ;
        }



}
/*===============================================*/

function worker_new_cv_old($id)
{
    try {
        ConvertApi::setApiSecret(env('FILE_CONVERTER_KEY'));

        $result = ConvertApi::convert('png', [
            'File' => route('cvs_view', $id),
            'WebHook' => route('cvs_view', $id),
        ], 'html'
        );

        if(isset($result->response['Files'][0])&&!empty($result->response['Files'][0])) {

            $name = Str::random(5) . '_' . time() . '.png';
            $dirname = 'uploads/new_cvs/time_' . $name;
            $result->saveFiles(base_path('/public/' . $dirname));
            return $dirname;
        }else{

            return null;

        }
    } catch (\Exception $e) {
        return null;

    }

}
function worker_new_cv($id)
{
//    try {
    $dirname='/uploads/cvs/time_'.Str::random(5).'_'.time().'.jpeg';
    $path = public_path().$dirname;
//        Browsershot::url(url('').'/cvs_view/'.$id)->save($path);
    
Browsershot::url(url('').'/cvs_view/'.$id)->fullPage()
        ->setOption('landscape', true)
        ->setOption('viewport.width', 1400)
        ->setOption('viewport.height', 1080)
        ->save($path);
    return $dirname;
//    } catch (\Exception $e) {
//        return null;
//
//    }

}
//highlights the selected navigation on admin panel
if (! function_exists('sendSMS')) {
    function sendSMS($to, $from, $text, $template_id)
    {
        if (OtpConfiguration::where('type', 'nexmo')->first()->value == 1) {
            $api_key = env("NEXMO_KEY"); //put ssl provided api_token here
            $api_secret = env("NEXMO_SECRET"); // put ssl provided sid here

            $params = [
                "api_key" => $api_key,
                "api_secret" => $api_secret,
                "from" => $from,
                "text" => $text,
                "to" => $to
            ];

            $url = "https://rest.nexmo.com/sms/json";
            $params = json_encode($params);
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params),
                'accept:application/json'
            ));
            $response = curl_exec($ch);
            curl_close($ch);
            return $response;
        }
        elseif (OtpConfiguration::where('type', 'twillo')->first()->value == 1) {
            $sid = env("TWILIO_SID"); // Your Account SID from www.twilio.com/console
            $token = env("TWILIO_AUTH_TOKEN"); // Your Auth Token from www.twilio.com/console
            $client = new Client($sid, $token);
            try {
                $message = $client->messages->create(
                    $to, // Text this number
                    array(
                        'from' => env('VALID_TWILLO_NUMBER'), // From a valid Twilio number
                        'body' => $text
                    )
                );
            } catch (\Exception $e) {

            }

        }
        elseif (OtpConfiguration::where('type', 'ssl_wireless')->first()->value == 1) {
            $token = env("SSL_SMS_API_TOKEN"); //put ssl provided api_token here
            $sid = env("SSL_SMS_SID"); // put ssl provided sid here

            $params = [
                "api_token" => $token,
                "sid" => $sid,
                "msisdn" => $to,
                "sms" => $text,
                "csms_id" => date('dmYhhmi').rand(10000, 99999)
            ];

            $url = env("SSL_SMS_URL");
            $params = json_encode($params);

            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($params),
                'accept:application/json'
            ));

            $response = curl_exec($ch);

            curl_close($ch);

            return $response;
        }
        elseif (OtpConfiguration::where('type', 'fast2sms')->first()->value == 1) {

            if(strpos($to, '+91') !== false){
                $to = substr($to, 3);
            }

            if(env("ROUTE") == 'dlt_manual'){
                $fields = array(
                    "sender_id" => env("SENDER_ID"),
                    "message" => $text,
                    "template_id" => $template_id,
                    "entity_id" => env("ENTITY_ID"),
                    "language" => env("LANGUAGE"),
                    "route" => env("ROUTE"),
                    "numbers" => $to,
                );
            }
            else {
                $fields = array(
                    "sender_id" => env("SENDER_ID"),
                    "message" => $text,
                    "language" => env("LANGUAGE"),
                    "route" => env("ROUTE"),
                    "numbers" => $to,
                );
            }
            $auth_key = env('AUTH_KEY');
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($fields),
                CURLOPT_HTTPHEADER => array(
                    "authorization: $auth_key",
                    "accept: */*",
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            return $response;
        }
        elseif(OtpConfiguration::where('type', 'mimo')->first()->value == 1) {
            $token = MimoUtility::getToken();
            MimoUtility::sendMessage($text, $to, $token);
            MimoUtility::logout($token);
        }
    }
}

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






//converts currency to home default currency
if (! function_exists('convert_price')) {
    function convert_price($price)
    {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if($business_settings != null){
            $currency = Currency::find($business_settings->value);
            $price = floatval($price) / floatval($currency->exchange_rate);
        }

        $code = \App\Currency::findOrFail(get_setting('system_default_currency'))->code;
        if(Session::has('currency_code')){
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        }
        else{
            $currency = Currency::where('code', $code)->first();
        }

        $price = floatval($price) * floatval($currency->exchange_rate);

        return $price;
    }
}

//formats currency
if (! function_exists('format_price')) {
    function format_price($price)
    {
        if (get_setting('decimal_separator') == 1) {
            $fomated_price = number_format($price, get_setting('no_of_decimals'));
        }
        else {
            $fomated_price = number_format($price, get_setting('no_of_decimals'), ',' , ' ');
        }

        if(get_setting('symbol_format') == 1){
            return currency_symbol().$fomated_price;
        } else if(get_setting('symbol_format') == 3){
            return currency_symbol().' '.$fomated_price;
        } else if(get_setting('symbol_format') == 4) {
            return $fomated_price.' '.currency_symbol();
        }
        return $fomated_price.currency_symbol();

    }
}

//formats price to home default price with convertion
if (! function_exists('single_price')) {
    function single_price($price)
    {
        return format_price(convert_price($price));
    }
}


if (! function_exists('currency_symbol')) {
    function currency_symbol()
    {
        $code = \App\Currency::findOrFail(get_setting('system_default_currency'))->code;
        if(Session::has('currency_code')){
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        }
        else{
            $currency = Currency::where('code', $code)->first();
        }
        return $currency->symbol;
    }
}

if(! function_exists('renderStarRating')){
    function renderStarRating($rating,$maxRating=5) {
        $fullStar = "<i class = 'las la-star active'></i>";
        $halfStar = "<i class = 'las la-star half'></i>";
        $emptyStar = "<i class = 'las la-star'></i>";
        $rating = $rating <= $maxRating?$rating:$maxRating;

        $fullStarCount = (int)$rating;
        $halfStarCount = ceil($rating)-$fullStarCount;
        $emptyStarCount = $maxRating -$fullStarCount-$halfStarCount;

        $html = str_repeat($fullStar,$fullStarCount);
        $html .= str_repeat($halfStar,$halfStarCount);
        $html .= str_repeat($emptyStar,$emptyStarCount);
        echo $html;
    }
}




if (! function_exists('convertPrice')) {
    function convertPrice($price)
    {
        $business_settings = BusinessSetting::where('type', 'system_default_currency')->first();
        if ($business_settings != null) {
            $currency = Currency::find($business_settings->value);
            $price = floatval($price) / floatval($currency->exchange_rate);
        }
        $code = Currency::findOrFail(BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;
        if (Session::has('currency_code')) {
            $currency = Currency::where('code', Session::get('currency_code', $code))->first();
        } else {
            $currency = Currency::where('code', $code)->first();
        }
        $price = floatval($price) * floatval($currency->exchange_rate);
        return $price;
    }
}


function translate($key, $lang = null){

//    if($lang == null){
//        $lang = App::getLocale();
//    }
//    $translation_def= Cache::remember('translations', 20, function()  {
//        return Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->get();
//    });
//    $translation_def=$translation_def->where('lang_key', $key)->first();
//    if($translation_def == null){
//        $translation_def = new Translation;
//        $translation_def->lang = env('DEFAULT_LANGUAGE', 'en');
//        $translation_def->lang_key = $key;
//        $translation_def->lang_value = $key;
//        $translation_def->save();
//    }
//    //Check for session lang
//    $translation_locale= Cache::remember('translations', 20, function()  {
//        return Translation::get();
//    });
//    $translation_locale=$translation_locale->where('lang_key', $key)->where('lang', $lang)->first();
//    if($translation_locale != null && $translation_locale->lang_value != null){
//        return $translation_locale->lang_value;
//    }
//    elseif($translation_def->lang_value != null){
//        return $translation_def->lang_value;
//    }
//    else{
//        return $key;
//    }






//     if($lang == null){
// >>>>>>> 3001cf75c9385a3310d712e7d8d06ada9669f117
//         $lang = App::getLocale();
//     // }
    // if(Session::has('locale')){
    //   $lang = Session::get('locale', Config::get('app.locale'));
    //   } else{
    //     $lang = 'ar';
    //   }
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



function remove_invalid_charcaters($str)
{
    $str = str_ireplace(array("\\"), '', $str);
    return str_ireplace(array('"'), '\"', $str);
}


function timezones(){
    return Timezones::timezonesToArray();
}

if (!function_exists('app_timezone')) {
    function app_timezone()
    {
        return config('app.timezone');
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
function hex2rgba($color, $opacity = false) {
    return Colorcodeconverter::convertHexToRgba($color, $opacity);
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

if (!function_exists('isSeller')) {
    function isSeller()
    {
        if (Auth::check() && Auth::user()->user_type == 'seller') {
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

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

// duplicates m$ excel's ceiling function
if( !function_exists('ceiling') )
{
    function ceiling($number, $significance = 1)
    {
        return ( is_numeric($number) && is_numeric($significance) ) ? (ceil($number/$significance)*$significance) : false;
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
        "userName": "rawafd",
        "numbers": "$number",
        "userSender": "Rawafd Najd",
        "apiKey": "8948648e03711bcd59f19d6f69333bad",
        "msg": "$msg"
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
function getReviews() {
    $url = 'https://maps.googleapis.com/maps/api/place/details/json?cid=14361941205873681812&key=AIzaSyCdcYe95svvXHMYYZEbKN7Nfd268_iJOY0&language=ar&rating=5.0&reviewsLimit=20';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $data = curl_exec($ch);
    curl_close($ch);

    $arrayData = json_decode($data, true); // json object to array conversion
    if(isset($arrayData['result'])){
        $result = $arrayData['result'];

        $total_users    = $result['user_ratings_total']; // display total number of users who rated
        $overall_rating = $result['rating']; // display total average rating
        $reviews        = $result['reviews'];   //holds information like author_name, author_url, language, profile_photo_url, rating, relative_time_description, text, time
//    dd($reviews);
//display on view
//    var_dump($total_users);
//    var_dump($overall_rating);
//    dd($reviews);
        return $reviews;
    }else{
        $reviews=[];
        return $reviews;
    }

}


?>