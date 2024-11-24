<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\RecruitmentStep;
use App\Product;
use Illuminate\Http\Request;

class RecruitmentStepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $recruitment_steps = RecruitmentStep::orderBy('link', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $recruitment_steps = $recruitment_steps->where('title', 'like', '%'.$sort_search.'%');
        }
        $recruitment_steps = $recruitment_steps->paginate(15)->appends(request()->query());

        return view('backend.SettingManagement.main_page.main', compact('recruitment_steps', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.SettingManagement.recruitment_steps.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recruitment_step = new RecruitmentStep();
        $recruitment_step->title = $request->title;
        $recruitment_step->description = $request->description;
        $recruitment_step->link = $request->link;
        $recruitment_step->icons = $request->icons;
        $recruitment_step->image = $request->image;
        $recruitment_step->save();

        flash(translate('تم الاضافة بنجاح'))->success();
        return redirect()->route('website.main');

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
    public function edit(Request $request, $id)
    {
        $lang   = $request->lang;
        $recruitment_step  = RecruitmentStep::findOrFail($id);
        return view('backend.SettingManagement.recruitment_steps.edit', compact('recruitment_step','lang'));
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
        $recruitment_step = RecruitmentStep::findOrFail($id);
//        if($request->lang == env("DEFAULT_LANGUAGE")){
//            $brand->name = $request->name;
//        }


        $recruitment_step->title = $request->title;
        $recruitment_step->description = $request->description;
        $recruitment_step->link = $request->link;
        $recruitment_step->icons = $request->icons;
        $recruitment_step->image = $request->image;
        $recruitment_step->save();


        flash(translate('تم التعديل بنجاح'))->success();
        return redirect()->route('website.main');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        RecruitmentStep::destroy($id);

        flash(translate('تم المسح بنجاح'))->success();
        return 1;

    }
    public function destroyAll()
    {
        RecruitmentStep::destroy(13);

        RecruitmentStep::truncate();

        return 1;

    }

}
