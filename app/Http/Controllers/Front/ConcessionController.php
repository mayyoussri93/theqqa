<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Concession;
use Illuminate\Http\Request;


class ConcessionController extends Controller
{

    public  function indexUserSite(){
       $housemades = Concession::paginate(10);
       return view('frontend.Concession.index',['housemades'=>$housemades]);

    } //indexUserSite method end





}
