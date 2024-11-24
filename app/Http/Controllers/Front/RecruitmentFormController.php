<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecruitmentFormRequest;
use App\Models\RecruitmentForm;
use App\Utility\NotificationUtility;
use auth;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RecruitmentFormController extends Controller
{

    public function viewRecruitmentForm()
    {
        return view('frontend.recruitment-request');

    }
    public function saveRecruitmentForm(RecruitmentFormRequest $request)
    {
        $rec_form=  new RecruitmentForm();
        $rec_form->user_id= auth::user()->id;
        $rec_form->name= $request->name;
        $rec_form->email= $request->email;
        $rec_form->phone= $request->phone;
        $rec_form->address= $request->address;
        $rec_form->iduser= $request->id_user;
        $rec_form->visa_id= $request->visa_id;
        $rec_form->nationality_id= $request->nationality_id;
        $rec_form->occuption_id= $request->occuption_id;
        $rec_form->social_id= $request->social_id;
        $rec_form->age_id= $request->age_id;
        $rec_form->region_id= $request->region_id;
        $rec_form->lang_id= $request->lang_id;
        $rec_form->exper_id= $request->exper_id;
        $rec_form->requirement_id= $request->requirement_id;
        $rec_form->save();
        NotificationUtility::set_notification(
            "new_special_booking_form",
            "يوجد طلب استقدام خاص جديد",
            route('recruitment_form_request.view', ['id'=>$rec_form->id]),
           0,
            Auth::user()->id,
            'admin',
            $rec_form->id
        );
        flash('تم ارسال طلبك بنجاح')->success();

        return back();



    }


}