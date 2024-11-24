<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\BrandTranslation;
use App\Product;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $services = Brand::orderBy('name', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $services = $services->where('name', 'like', '%'.$sort_search.'%');
        }
        $services = $services->paginate(15)->appends(request()->query());
        return view('backend.website.main', compact('services', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.SettingManagement.main_page.services.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->link = $request->link;
        $brand->description = $request->description;
        $brand->logo = $request->logo;
        $brand->save();

        $brand_translation = BrandTranslation::firstOrNew(['lang' => env('DEFAULT_LANGUAGE'), 'brand_id' => $brand->id]);
        $brand_translation->name = $request->name;
        $brand_translation->save();

        flash(translate('تم إدخــال الخدمة بنجــاح'))->success();
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
        $brand  = Brand::findOrFail($id);
        return view('backend.SettingManagement.main_page.services.edit', compact('brand','lang'));
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
        $brand = Brand::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $brand->name = $request->name;
        }
        $brand->link = $request->link;
        $brand->description = $request->description;

        $brand->logo = $request->logo;
        $brand->save();

        $brand_translation = BrandTranslation::firstOrNew(['lang' => $request->lang, 'brand_id' => $brand->id]);
        $brand_translation->name = $request->name;
        $brand_translation->save();

        flash(translate('تم تحديـث الخدمــة بنجـــاح'))->success();
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
        $brand = Brand::findOrFail($id);
//        foreach ($brand->brand_translations as $key => $brand_translation) {
//            $brand_translation->delete();
//        }
        Brand::destroy($id);

        flash(translate('تم حـذف الخدمة بنجــاح'))->success();
        return redirect()->route('website.main');

    }
}
