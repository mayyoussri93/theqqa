<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Hash;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $settings = new SeoSetting();
        $sort_search = $request->search;

        if ($request->has('search')){
            $settings = $settings->where('meta_title', 'like', '%'.$sort_search.'%');
        }
        $settings = $settings->paginate(10);
        return view('backend.website.other_pages', compact('settings','sort_search'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.SettingManagement.other_pages.seo_setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(SeoSetting::where('current_url', $request->current_url)->first() == null){
            $seo = new SeoSetting;
            $seo->current_url = urlencode($request->current_url);
            $seo->meta_h1 = $request->meta_h1;
            $seo->meta_title = $request->meta_title;
            $seo->meta_img = $request->meta_img;
            $seo->meta_description=$request->meta_description;
            $meta_keywords = array();
            if($request->meta_keywords[0] != null){
                foreach (json_decode($request->meta_keywords[0]) as $key => $tag) {
                    array_push($meta_keywords, $tag->value);
                }
            }
            $seo->meta_keywords = implode(',', $meta_keywords);
            if($seo->save()){

                    flash(translate('تم الاضافة بنجاح'))->success();
                    return redirect()->route('website.other_pages');

            }
        }

        flash(translate('هذة الرابطه لها اعدادات بالفعل'))->error();
        return back();
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
        $setting = SeoSetting::findOrFail($id);
        return view('backend.SettingManagement.other_pages.seo_setting.edit', compact('setting'));
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
        $seo = SeoSetting::findOrFail($id);
        $seo->current_url = urlencode($request->current_url);
        $seo->meta_title = $request->meta_title;
        $seo->meta_img = $request->meta_img;
        $seo->meta_h1 = $request->meta_h1;
        $seo->meta_description=$request->meta_description;

        $meta_keywords = array();
        if($request->meta_keywords[0] != null){
            foreach (json_decode($request->meta_keywords[0]) as $key => $tag) {
                array_push($meta_keywords, $tag->value);
            }
        }
        $seo->meta_keywords = implode(',', $meta_keywords);
        if($seo->save()){
                flash(translate('تم تعديل الاعدادات بنجاح'))->success();
                return redirect()->route('website.other_pages');
        }
        flash(translate('حــدث خطـــأ مــا'))->error();
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

        if (SeoSetting::destroy($id)) {
            flash(translate('تم المسح بنجاح'))->success();
            return redirect()->route('website.other_pages');
        }

        flash(translate('حــدث خطــأ مــا'))->error();
        return back();
    }
}
