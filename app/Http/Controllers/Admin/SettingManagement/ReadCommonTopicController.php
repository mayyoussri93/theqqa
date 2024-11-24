<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\ReadCommonTopic;
use Hash;
use Illuminate\Http\Request;

class ReadCommonTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $topic_id=$request->topic_id;
        $commons = ReadCommonTopic::where('topic_id',$request->topic_id)->paginate(10);
        return view('backend.SettingManagement.commen_topics.read.index', compact('commons','topic_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( )
    {
//        $roles = Role::all();
        return view('backend.SettingManagement.commen_topics.read.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $common = new ReadCommonTopic;
            $common->topic_id = $request->tobic_id;
            $common->title = $request->title;
            $common->link = $request->link;

           $common->save();

        flash(translate('تـم إرســال الموضـوع بنجـــاح'))->success();
        return redirect()->route('read_common_topics.index',['topic_id'=>$common->topic_id]);

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

        $commen = ReadCommonTopic::findOrFail(decrypt($id));

        return view('backend.SettingManagement.commen_topics.read.edit', compact('commen' ));
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

        $common =  ReadCommonTopic::findOrFail($id);
        $common->title = $request->title;
        $common->link = $request->link;
        $common->save();
        flash(translate('تم تحديث الموضوع بنجـــاح'))->success();
        return redirect()->route('read_common_topics.index',['topic_id'=>$common->topic_id]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $topic_id=ReadCommonTopic::find($id);
        ReadCommonTopic::destroy($id);

            flash(translate('تم حذف المــوضـوع بنجـــاح'))->success();
            return redirect()->route('read_common_topics.index',['topic_id'=>$topic_id]);

    }
}
