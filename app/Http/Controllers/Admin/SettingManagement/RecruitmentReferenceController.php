<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\RecruitmentReference;
use App\Product;
use Illuminate\Http\Request;

class RecruitmentReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $recruitment_references = RecruitmentReference::orderBy('link', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $recruitment_references = $recruitment_references->where('link', 'like', '%'.$sort_search.'%');
        }
        $recruitment_references = $recruitment_references->paginate(15)->appends(request()->query());
        return view('backend.SettingManagement.main_page.recruitment_references.index', compact('recruitment_references', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.SettingManagement.main_page.recruitment_references.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recruitment_reference = new RecruitmentReference();
        $recruitment_reference->link = $request->link;
        $recruitment_reference->image = $request->logo;
        $recruitment_reference->save();

        flash(translate('تم إدخــال مرجع الاستقــدام بنجــاح'))->success();
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
        $recruitment_reference  = RecruitmentReference::findOrFail($id);
        return view('backend.SettingManagement.main_page.recruitment_references.edit', compact('recruitment_reference','lang'));
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
        $recruitment_reference = RecruitmentReference::findOrFail($id);
//        if($request->lang == env("DEFAULT_LANGUAGE")){
//            $brand->name = $request->name;
//        }

        $recruitment_reference->link = $request->link;
        $recruitment_reference->image = $request->logo;
        $recruitment_reference->save();


        flash(translate('تم تحديث مرجع الاستقدام بنجاح'))->success();
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

        RecruitmentReference::destroy($id);

        flash(translate('تم حـذف مرجـع الاسـتقـدام بنجــاح'))->success();
        return redirect()->route('website.main');

    }
}
