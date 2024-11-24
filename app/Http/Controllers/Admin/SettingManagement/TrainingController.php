<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\Trainee;
use App\Models\Training;
use Illuminate\Http\Request;

class TrainingController extends Controller
{

    public function __construct()
    {
//        $this->middleware(['permission:show freelancer skills'])->only('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $skills = Training::orderBy('created_at', 'desc');
        $trainee_name=$request->trainee_name ;
        if($request->trainee_name != null){
            $skills=  $skills->where('title', 'like', '%'.$request->trainee_name.'%');
        }
        $skills = $skills->paginate(10);
        return view('backend.SettingManagement.training.index', compact('skills','trainee_name'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $job = new Training();
        $job->title = $request->title;
        $job->location = $request->location;

        $requirements = array();
        if($request->requirements[0] != null){
            foreach (json_decode($request->requirements[0]) as $key => $val) {
                array_push($requirements, $val->value);
            }
        }
        $job->requirements = implode(',', $requirements);
        $tasks = array();
        if($request->tasks[0] != null){
            foreach (json_decode($request->tasks[0]) as $key => $val) {
                array_push($tasks, $val->value);
            }
        }
        $job->tasks = implode(',', $tasks);
        if ($job->save()) {
            flash('تم ادخال التدريب بنجاح')->success();
            return redirect()->route('training.index');
        }
        else {
            flash("حدث خطأ ما")->error();
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
            $skill = Training::findOrFail(decrypt($id));
            return view('backend.SettingManagement.training.edit', compact('skill'));



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job = Training::findOrFail($id);
        $job->title = $request->title;
        $job->location = $request->location;
        $requirements = array();
        if($request->requirements[0] != null){
            foreach (json_decode($request->requirements[0]) as $key => $tag) {
                array_push($requirements, $tag->value);
            }
        }
        $job->requirements = implode(',', $requirements);
        $task = array();
        if($request->tasks[0] != null){
            foreach (json_decode($request->tasks[0]) as $key => $tag) {
                array_push($task, $tag->value);
            }
        }
        $job->tasks =implode(',', $task);
        $job->save();
            flash("تم تعديل التدريب بنجاح")->success();
            return redirect()->route('training.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $skill = Training::findOrFail($id);
            if(Training::destroy($id)){
                flash("تم مسح التدريب بنجاح")->success();
                return redirect()->route('training.index');
            }
            else {
                flash("حدث حطأ ما")->error();
                return back();
            }

    }

    public function changeStatus(Request $request)
    {
        $Cv = Training::findOrFail($request->id);

            $Cv->is_active = $request->status;
            if ($Cv->save()) {
                return 1;
            }

    }
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


    public function applicantList(Request $request)
    {
        $val = Trainee::orderBy('created_at', 'desc');


        $name=$request->name ;
        $training_id=$request->training_id;
        if($request->name != null){
            $val=  $val->where('name', 'like', '%'.$request->name.'%')->orWhere('email', 'like', '%'.$request->name.'%');
        }
        if($request->job_id != null){
            $val=  $val->where('training_id',$request->training_id);
        }
        $val=$val->paginate(10);
        return view('backend.SettingManagement.training.trainees.index', compact('val','training_id','name'));

    }
    public function applicantDestroy($id)
    {
        $skill = Trainee::findOrFail($id);
        if(Trainee::destroy($id)){
            flash("تم مسح الطلب بنجاح")->success();
            return redirect()->route('trainees.index');
        }
        else {
            flash("حدث حطأ ما")->error();
            return back();
        }

    }

}
