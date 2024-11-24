<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Translation;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Session;

class LanguageController extends Controller
{

    public function index(Request $request)
    {
        $languages = Language::paginate(10);
        return view('backend.SettingManagement.languages.index', compact('languages'));
    }

    public function create(Request $request)
    {
        return view('backend.SettingManagement.languages.create');
    }

    public function store(Request $request)
    {
        $language = new Language;
        $language->name = $request->name;
        $language->code = $request->code;
        if($language->save()){

            flash(translate('تـم إدخــال اللــغة بنجـــاح'))->success();
            return redirect()->route('languages.index');
        }
        else{
            flash(translate('حــدث خطــأ مــا'))->error();
            return back();
        }
    }

    public function show(Request $request, $id)
    {
        $sort_search = null;
        $language = Language::findOrFail(decrypt($id));
        $lang_keys = Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'));
        if ($request->has('search')){
            $sort_search = $request->search;
            $lang_keys = $lang_keys->where('lang_key', 'like', '%'.$sort_search.'%');
        }
        $lang_keys = $lang_keys->paginate(50);
        return view('backend.SettingManagement.languages.language_view', compact('language','lang_keys','sort_search'));
    }

    public function edit($id)
    {
        $language = Language::findOrFail(decrypt($id));
        return view('backend.SettingManagement.languages.edit', compact('language'));
    }

    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        if (env('DEFAULT_LANGUAGE') == $language->code) {
            flash(translate('لا يمـكــن تعــديــل اللـــغة الافتراضيــة'))->error();
            return back();
        }
        $language->name = $request->name;
        $language->code = $request->code;
        if($language->save()){
            flash(translate('تــم تحديـــث اللــغة بنجـــاح'))->success();
            return redirect()->route('languages.index');
        }
        else{
            flash(translate('حـــدث خطـــأ مـــا'))->error();
            return back();
        }
    }

    public function key_value_store(Request $request)
    {
        $language = Language::findOrFail($request->id);
        foreach ($request->values as $key => $value) {
            $translation_def = Translation::where('lang_key', $key)->where('lang', $language->code)->first();
            if($translation_def == null){
                $translation_def = new Translation;
                $translation_def->lang = $language->code;
                $translation_def->lang_key = $key;
                $translation_def->lang_value = $value;
                $translation_def->save();
            }
            else {
                $translation_def->lang_value = $value;
                $translation_def->save();
            }
        }
        flash(translate('تــم تحديــث التـرجمــة الــي ').$language->name)->success();
        return back();
    }

    public function update_rtl_status(Request $request)
    {
        $language = Language::findOrFail($request->id);
        $language->rtl = $request->status;
        if($language->save()){
            flash(translate('تــم تحديث الاتجاه من اليمين الي اليسار بنجــاح'))->success();
            return 1;
        }
        return 0;
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        if (env('DEFAULT_LANGUAGE') == $language->code) {
            flash(translate('لا يمكــن حــذف اللغة الافتراضيــة'))->error();
        }
        else {
            if($language->code == Session::get('locale')){
                Session::put('locale', env('DEFAULT_LANGUAGE'));
            }
            Language::destroy($id);
            flash(translate('تم حــذف اللغـــة بنجــــاح'))->success();
        }
        return redirect()->route('languages.index');
    }
}
