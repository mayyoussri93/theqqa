<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\CutactusExport;
use Auth;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Yajra\DataTables\DataTables;

class  ContactUsController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
//            'subject' => 'required',
            'massage' => 'required',

        ]);
        if ($validator->passes()) {
            $conversation = new ContactUs();
            $conversation->name = $request->name;
            $conversation->email = $request->email;
            $conversation->subject = $request->subject;
            $conversation->phone = $request->phone;
            $conversation->massage = $request->massage;

            $conversation->save();
            return response()->json(['success'=>translate('تم ارسال طلبك بنجاح الى المسؤلين')]);

        }

        return response()->json(['error'=>$validator->errors()]);

    }


}
