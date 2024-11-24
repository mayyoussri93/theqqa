<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait CvTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function verifyOccupation($data ) {

        if( $data=='house keeper' ) {
            return 1;
        }elseif ($data =='personal driver'){
            return 5;
        }elseif ($data=='Worker'){
            return 8;
        }
            elseif ($data=='cooker'){
        return 9;
        }


    }
    public function verifyReligion($data ) {

        if( $data=='Christian' ) {
            return 2;
        }elseif ($data =='Muslim'){
            return 1;
        }


    }
    public function verifyExperience($data ) {

        if( $data=='لا' ) {
            return 2;
        }elseif ($data =='نعم'){
            return 1;
        }


    }
    public function verifyOffice($data)
    {
        $data=strtolower($data);
        if( $data==strtolower('EXCEPTIONAL BROADWAY' )) {
            return 2;
        }elseif ($data==strtolower('EUNYSMART')){
            return 1;
        }
        elseif ($data==strtolower('MAKUNGU')){
            return 3;
        }
        elseif ($data==strtolower('Aviate International')){
            return 80;
        }
        elseif ($data==strtolower('M/S. NISHUTI INTERNATIONAL')){
            return 208;
        }
        elseif ($data==strtolower('M/S. Millennium Overseas Ltd')){
            return 12;
        }
        elseif ($data==strtolower('S. A. Trading')){
            return 12;
        }
        elseif ($data==strtolower('express')){
            return 30;
        }

elseif ($data==strtolower('Ameer aviansh')){
            return 13;
        }
        elseif ($data==strtolower('WASEL RECRUITMENT')){
            return 10;
        }elseif ($data==strtolower('AL RAZZAQ GROUP OF COMPANY')){
            return 11;
        }elseif ($data==strtolower('Millennium Overseas Ltd' )){
            return 12;
        }
        elseif ($data==strtolower('AMIR AVIATION LIMITED' )){
            return 13;
        }
        elseif ($data==strtolower('SHAINA TOURS')){
            return 15;
        }
        elseif ($data==strtolower('UNICO MANPOWER')){
            return 18;
        }
        elseif ($data==strtolower('tasper international')){
            return 19;
        }
        elseif ($data==strtolower('ADNAN MALIK ENTERPRISES')){
            return 26;
        }
        elseif ($data==strtolower('SAIF ALDE')){
            return 212;
        }
        elseif ($data==strtolower('ABDULLAH TRAVELS')){
            return 211;
        }
        elseif ($data==strtolower('AL ARAFAH INTERNATIONAL')){
            return 16;
        }
        elseif ($data==strtolower('WORLD VISION')){
            return 27;
        }
        elseif ($data==strtolower('FINDSTAFF')){
            return 28;
        }
        elseif ($data==strtolower('TALENT GETAWAY')){
            return 29;
        }
        elseif ($data==strtolower('SHAHINA TOURS')){
            return 218;
        }





    }
    public function verifyBooking($data )
    {
        if( $data=='لا' ) {
            return 0;
        }elseif ($data =='نعم'){
            return 1;
        }
    }


    public function verifyNationality($data, $occupation,$exper) {
        $data=strtolower($data);
        if( $data==strtolower('KENYA' )) {
            return 113;
        }elseif ($data==strtolower('Uganda')){
            return 150;
        }elseif ($data==strtolower('Bangladesh')){
            return 18;
        }elseif ($data==strtolower('filipino')){
            return 174;
        }elseif ($data==strtolower('india') && $exper=="ﻻ"){
            return 100;
        }
        elseif ($data==strtolower('india') && $exper=="نعم"){
            return 101;
        }
        elseif ($data==strtolower('SRILANKA') &&  $occupation==strtolower('house keeper')){
            return 297;
        }
        elseif ($data==strtolower('SRILANKA') &&  $occupation==strtolower('personal driver')){
            return 298;
        }
        elseif ($data==strtolower('Philippines')){
            return 174;
        }
        elseif ($data==strtolower('pakistan')){
            return 299;
        }



    }

}