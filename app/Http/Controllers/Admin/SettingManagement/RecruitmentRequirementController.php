<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\RecruitmentRequirement;
use App\Product;
use Illuminate\Http\Request;

class RecruitmentRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $recruitment_requirements = RecruitmentRequirement::orderBy('title', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
         
            $recruitment_requirements = $recruitment_requirements->where('title', 'like', '%'.$sort_search.'%');
        }
        $recruitment_requirements = $recruitment_requirements->paginate(15)->appends(request()->query());
        return view('backend.SettingManagement.main_page.recruitment_requirements.index', compact('recruitment_requirements', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.SettingManagement.main_page.recruitment_requirements.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recruitment_requirement = new RecruitmentRequirement();
        $recruitment_requirement->title = $request->title;
        $recruitment_requirement->link = $request->link;
        $recruitment_requirement->description = $request->description;
        $recruitment_requirement->save();

        flash(translate('تم إدخال طلب الاستقدام بنجـــاح'))->success();
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
        $recruitment_requirement  = RecruitmentRequirement::findOrFail($id);
        return view('backend.SettingManagement.main_page.recruitment_requirements.edit', compact('recruitment_requirement','lang'));
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
        $recruitment_requirement = RecruitmentRequirement::findOrFail($id);

        $recruitment_requirement->title = $request->title;
        $recruitment_requirement->link = $request->link;
        $recruitment_requirement->description = $request->description;
        $recruitment_requirement->save();

        flash(translate('تم تحديث طلب الاستقدام بنجــاح'))->success();
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

        RecruitmentRequirement::destroy($id);
        flash(translate('تم حذف طلب الاستقدام بنجـــاح'))->success();
        return redirect()->route('website.main');

    }
}
