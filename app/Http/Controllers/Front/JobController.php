<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{

    public function saveApplicant(Request $request)
    {
        $job = new Applicant();
        $job->name = $request->name;
        $job->phone = $request->phone;
        $job->email = $request->email;
        $job->job_id = $request->job_id;
        $job->nots = $request->nots;

        $job->cv_path= $request->cv_files->store('uploads/applicant');





        if ($job->save()) {
            flash("تم ارسال طلبك بنجاح")->success();
            return back();
        }

    }


}
