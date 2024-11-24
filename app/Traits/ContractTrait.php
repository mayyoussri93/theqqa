<?php

namespace App\Traits;

use App\Models\Customer;
use App\Models\Cv;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

trait ContractTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function createCv($name,$passport_number,$occupation,$country_id,$religion_id,$office,$contract_date) {

        $cv=  new Cv();
        $cv->cvs_name=$name;
        $cv->office= $this->verifyOffice($office);
        $cv->is_rapid=1;
        $cv->cv_rev_type=1;
        $cv->national_id= $this->verifyWorkerNationality($country_id);
        $cv->occuption_id= $this->verifyWorkerOccupation($occupation);
        $cv->passport_id= $passport_number;
        $cv->region_id= $this->verifyWorkerReligion($religion_id);
        $cv->created_at =  date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $contract_date) ));
        $cv->save();
        return $cv;
    }
    public function verifyOffice($data)
    {
        $data=strtolower($data);

     if( $data==strtolower('exceptional broadway' )) {
         return 2;
     }elseif ($data==strtolower('EUNYSMART')){
         return 1;
     }
     elseif ($data==strtolower('alrazzaq group of company')){
         return 11;
     }
     elseif ($data==strtolower('makungu')){
         return 3;
     }
     elseif ($data==strtolower('s. a. trading')){
         return 205;
     }
    // elseif ($data==strtolower('aviate international')){
    //     return 80;
    // }
     elseif ($data==strtolower('nishuti international')){
         return 208;
     }
     elseif ($data==strtolower('wasel')){
         return 10;
     }
     elseif ($data==strtolower('millennium overseas')){
         return 12;
     }
     elseif ($data==strtolower('saif alden')){
         return 212;
     }
     elseif ($data==strtolower('tasper international') ){
         return 19;
     }
     elseif ($data==strtolower('ameer aviansh')){
         return 13;
     }
     elseif ($data==strtolower('unico manpower')){
         return 18;
     }
     elseif ($data==strtolower('shahina tours')){
         return 218;
     }
     elseif ($data==strtolower('adnan malik enterprises')){
         return 26;
     }
     elseif ($data==strtolower('leadwell')){
         return 220;
     }
     elseif ($data==strtolower('alsundus')){
         return 221;
     }
     elseif ($data==strtolower('aviate international')){
         return 225;
     }
     elseif ($data=='-' or $data=='_' or $data==0  or $data==""){
         return null;
     }



    }
    public function verifyWorkerReligion($data ) {
        if( $data=='Christian' OR  $data=='مسيحي' OR  $data=='غير مسلمة' OR  $data=='غير مسلم') {
            return 2;
        }elseif ($data =='Muslim' OR  $data=='مسلم' OR  $data=='مسلمة'){
            return 1;
        }


    }
    public function verifyWorkerOccupation($data ) {
        if ( $data=="سائق خاص"){
            return 5;
        }elseif ( $data=='عامل منزلى'){
            return 7;
        }
        elseif ($data=='عاملة منزلية'){
            return 1;
        }
        elseif ( $data=="طباخ منزلية"){
            return 6;
        }

    }
    public function verifyWorkerNationality($data)
    {
//        $data=strtolower($data);

        if( $data=='كينيا' ) {
            return 113;
        }
        elseif ($data=='الفلبين' ){
            return 174;
        }
        elseif ($data=='الهند'){
            return 100;
        }
        elseif ($data=='بنجلاديش' ){
            return 18;
        }
        elseif ($data=='سيريلانكا'){
            return 297;
        }
        elseif ($data=='مصر'){
            return 301;
        }elseif ($data=='اوغندا'){
            return 150;
        }
        elseif ($data=='باكستان'){
            return 299;
        }
        elseif ($data=='إثيوبيا'){
            return 300;
        }



    }
    public function createUser($name,$user_id ,$phone,$nationality_id,$client_address) {

$check_user=User::where('phone',$phone)->where('name',$name)->first();
if(empty($check_user)) {
    $client = User::create([
        'name' => $name,
        'phone' => $phone,
        'password' => Hash::make(rand(100000,999999)),
        'verification_code' => rand(1000, 9999),
        'nationality_id'=>$nationality_id,
       'address'=> $client_address,
    ]);
    $customer = new Customer;
    $customer->user_id = $client->id;
//    $customer->birth_date=$client_birth_date;
    $customer->national_identification_number=$user_id;
    $customer->save();
}else{
    $client=$check_user;
    $client->name=$name;
    $client->phone=$phone;
     $client->nationality_id=$nationality_id;
    $client->address=$client_address;

    $client->update();
    $customer=$client->customer;
//    $customer->birth_date=$client_birth_date;
    $customer->national_identification_number=$user_id;
    $customer->update();
   
}


        return $client->id;
    }
    public function verifyNationality($data)
    {
        $data=strtolower($data);
        if( $data=='المملكة العربية السعودية') {
            return 191;
        }elseif ($data=='الاردن'){
            return 111;
        }elseif ($data=='الكويت'){
            return 117;
        }elseif ($data=='سوريا'){
            return 213;
        }elseif ($data=='فلسطين'){
            return 168;
        }
        elseif ($data=='مصر'){
            return 64;
        }
        elseif ($data=='اليمن'){
            return 243;
        }
        elseif ($data=='قبايل نازحه'){
            return 298;
        }
        elseif ($data=='السودان'){
            return 207;
        }
        elseif ($data=='الولايات المتحده'){
            return 231;
        }
        elseif ($data=='كوريا الجنوبية'){
            return 116;
        }
        elseif ($data=='المغرب'){
            return 148;
        }

        elseif ($data=='روسيا'){
            return 181;
        }

        elseif ($data=='لبنان'){
            return 121;
        }
        elseif ($data=='تونس'){
            return 222;
        }



    }

    public function CreateReservtion($cv,$user_id,$admin,$status,$status_date,$number_of_days ,$passport,$contract_date )
    {
        if( $cv == null){
            $res = new Reservation();
            $res->user_id = $user_id;
            $res->cv_id = null;
        }
        else {
            if (Reservation::whereNull('deleted_at')->where('cv_id', $cv->id)->where('user_id', $user_id)->count() == 0) {
                $res = new Reservation();
                $res->user_id = $user_id;
                $res->cv_id = $cv->id;
                $res->status = 2;
//        $res->code = env('ALPA_KEY') . $cv->nationality->key_code . date('Ymd') . rand(10, 99);
                $res->save();

            } else {
                $res = Reservation::whereNull('deleted_at')->where('cv_id', $cv->id)->where('user_id', $user_id)->first();
            }
        }
        $res->updated_at = date("Y-m-d h:i:s", strtotime( str_replace('/', '-', $status_date) ));
        $res->created_at =  date('Y-m-d h:i:s', strtotime( $contract_date) );

        if ($status=="التذاكر") {
            $res->status = 11;
            $cv->is_booking = 1;
            $cv->save();
        }elseif ($status=="تم الوصول") {
            $res->status = 15;
            $cv->is_booking = 1;
            $cv->save();
                $cv->arrived_date =Carbon::createFromFormat('d/m/Y', $status_date)->format('Y-m-d') ;
                $cv->save();

                $cv->expired_date =Carbon::parse($cv->arrived_date)->addDays(90)->format('Y-m-d') ;

                $cv->save();
        }elseif ($status=="تم التفييز") {
            $cv->is_booking = 1;
            $cv->save();
            $res->status = 10;
        }elseif ($status=="عقد جديد") {
            $cv->is_booking = 1;
            $cv->save();
            $res->status = 7;
        }elseif ($status=="متابعة الحالات") {
            $cv->is_booking = 1;
            $cv->save();
            $res->status = 9;
        }
        elseif ($status=="مرتجع") {
            $res->status = 13;


        }
        if ($status=="تم التفويض") {
            $cv->is_booking = 1;
            $cv->save();
            $res->status = 9;
        }elseif ($status=="تم التقديم الى مساند")
        {
            $cv->is_booking = 1;
            $cv->save();
            $res->status = 8;
        }

        if ($admin=="admin" or $admin=="بدون معقب" ){
            $res->administrator_id = 9;
        }
        elseif ($admin=="ا.سارة"){
            $res->administrator_id =5265;
        }
        elseif ($admin=="ا.اخلاص الأحمدي"){
            $res->administrator_id =3788;
        }
        elseif ($admin=="ا.منار الشمري" ){
            $res->administrator_id =74;
        }
        elseif ($admin=="ا.اسماء الحربي"){
            $res->administrator_id =82;
        }elseif ($admin=="أ.عبدالعزيز"){
            $res->administrator_id =81;
        }elseif ($admin=="ا.روزان"){
            $res->administrator_id =5266;
        }
        elseif ($admin=="ا.إلهام العمري"){
            $res->administrator_id =3789;
        }
        elseif ($admin=="ا.شهد السبيعي"){
            $res->administrator_id =3489;
        }  elseif ($admin=="ا.قرة العين"){
            $res->administrator_id =3790;
        }
        elseif ($admin=="ا.عمشاء الشمري"){
            $res->administrator_id =1731;
        }
        elseif ($admin=="ا.مها القرني"){
            $res->administrator_id =2183;
        }elseif ($admin=="ا.رانيا شمسان"){
            $res->administrator_id =2344;
        }
        elseif ($admin=="ا.سحايب العتيبي"){
            $res->administrator_id =3511;
        }
        elseif ($admin=="ا.رانيا الشمراني"){
            $res->administrator_id =3791;
        }elseif ($admin=="ا.أفراح العتيبي"){
            $res->administrator_id =4212;
        }
        elseif ($admin=="ا.ريم الشهري"){
            $res->administrator_id =4213;
        }

        $res->save();

        return $res->id;
    }




}