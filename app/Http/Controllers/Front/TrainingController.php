<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Trainee;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{

    public function saveTrainee(Request $request)
    {
        $job = new Trainee();
        $job->name = $request->name;
        $job->phone = $request->phone;
        $job->email = $request->email;
        $job->training_id = $request->training_id;
        $job->nots = $request->nots;

        $job->cv_path= $request->cv_files->store('uploads/trainee');





        if ($job->save()) {
            flash("تم ارسال طلبك بنجاح")->success();
            return back();
        }

    }



}
