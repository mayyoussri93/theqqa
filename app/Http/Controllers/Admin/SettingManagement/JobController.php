<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
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
        $sort_search=null;
        $skills = Job::orderBy('created_at', 'desc');
        if ($request->search != null) {
            $sort_search=$request->search;
            $skills = $skills->where('title', 'like', '%' . $request->search . '%');
        }
        $skills=$skills->paginate(10);
        return view('backend.SettingManagement.jobs.index', compact('skills','sort_search'));

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
        $job = new Job();
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
            flash('تم ادخال الوظيفة بنجاح')->success();
            return redirect()->route('jobs.index');
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
            $skill = Job::findOrFail(decrypt($id));
            return view('backend.SettingManagement.jobs.edit', compact('skill'));



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
        $job = Job::findOrFail($id);
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
            flash("تم تعديل الوظيفة بنجاح")->success();
            return redirect()->route('jobs.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $skill = Job::findOrFail($id);
            if(Job::destroy($id)){
                flash("تم مسح الوظيفة بنجاح")->success();
                return redirect()->route('jobs.index');
            }
            else {
                flash("حدث حطأ ما")->error();
                return back();
            }

    }

    public function changeStatus(Request $request)
    {
        $Cv = Job::findOrFail($request->id);

            $Cv->is_active = $request->status;
            if ($Cv->save()) {
                return 1;
            }

    }
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


    public function applicantList(Request $request)
    {
        $val = Applicant::orderBy('created_at', 'desc');


        $name=$request->name ;
        $job_id=$request->job_id;
        if($request->name != null){
            $val=  $val->where('name', 'like', '%'.$request->name.'%')->orWhere('email', 'like', '%'.$request->name.'%');
        }
        if($request->job_id != null){
            $val=  $val->where('job_id',$request->job_id);
        }
        $val=$val->paginate(10);
        return view('backend.SettingManagement.jobs.applicant.index', compact('val','job_id','name'));

    }
    public function applicantDestroy($id)
    {
        $skill = Applicant::findOrFail($id);
        if(Applicant::destroy($id)){
            flash("تم مسح الطلب بنجاح")->success();
            return redirect()->route('applicants.index');
        }
        else {
            flash("حدث حطأ ما")->error();
            return back();
        }

    }

}
