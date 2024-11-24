<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\CommonTopic;
use Hash;
use Illuminate\Http\Request;

class CommonTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commons = CommonTopic::paginate(10);
        return view('backend.SettingManagement.commen_topics.index', compact('commons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
//        $roles = Role::all();
        return view('backend.SettingManagement.commen_topics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $common = new CommonTopic;
            $common->main_name = $request->main_name;
            $common->alt_name = $request->alt_name;
            $common->details = $request->details;
        $common->video = $request->video;

//        if($request->hasFile('video')){
//            $common->video = $request->video->store('uploads/topics');
//          }
           $common->save();

        flash(translate('تم إرســال الموضـوع بنـــجـــاح'))->success();
        return redirect()->route('common_topics.index');

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

        $commen = CommonTopic::findOrFail(decrypt($id));

        return view('backend.SettingManagement.commen_topics.edit', compact('commen' ));
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

        $common =  CommonTopic::findOrFail($id);
        $common->main_name = $request->main_name;
        $common->alt_name = $request->alt_name;
        $common->details = $request->details;
        $common->video = $request->video;

//        if($request->hasFile('video')){
//            $common->video = $request->video->store('uploads/topics');
//        }
        $common->save();

        flash(translate('تــم تـحديــث المــوضـوع بنــجــــاح'))->success();
        return redirect()->route('common_topics.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CommonTopic::destroy($id);

            flash(translate('تـم تحـــديث المــوضــوع بنجـــاح'))->success();
            return redirect()->route('common_topics.index');

    }
}
