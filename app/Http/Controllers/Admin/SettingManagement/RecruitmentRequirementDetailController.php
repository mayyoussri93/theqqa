<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\RecruitmentRequirementDetail;
use App\Product;
use Illuminate\Http\Request;

class RecruitmentRequirementDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $recruitment_references_detailes = RecruitmentRequirementDetail::orderBy('title', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $recruitment_references_detailes = $recruitment_references_detailes->where('title', 'like', '%'.$sort_search.'%');
        }
        $recruitment_references_detailes = $recruitment_references_detailes->paginate(15)->appends(request()->query());
        return view('backend.SettingManagement.main_page.recruitment_requirements_details.index', compact('recruitment_references_detailes', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recruitment_requirement_detail = new RecruitmentRequirementDetail();
        $recruitment_requirement_detail->title = $request->title;
        $recruitment_requirement_detail->recruitment_requirement_id = $request->req_id;
        $recruitment_requirement_detail->image = $request->logo;
        $recruitment_requirement_detail->save();

        flash(translate('تم إدخال تفاصيل طلب الاستقدام بنجــاح'))->success();
        return redirect()->route('recruitment_references_detailes.index');

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
        $recruitment_requirement_detail  = RecruitmentRequirementDetail::findOrFail($id);
        return view('backend.SettingManagement.main_page.recruitment_requirements_details.edit', compact('recruitment_requirement_detail','lang'));
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
        $recruitment_requirement_detail = RecruitmentRequirementDetail::findOrFail($id);

        $recruitment_requirement_detail->title = $request->title;
        $recruitment_requirement_detail->recruitment_requirement_id = $request->req_id;
        $recruitment_requirement_detail->image = $request->logo;
        $recruitment_requirement_detail->save();

        flash(translate('تم تحديث تفاصيل طلب الاستقدام بنجاح'))->success();
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        RecruitmentRequirementDetail::destroy($id);
        flash(translate('تم حذف تفاصيل طلب الاستقدام بنجاح'))->success();
        return redirect()->route('recruitment_references_detailes.index');

    }
}
