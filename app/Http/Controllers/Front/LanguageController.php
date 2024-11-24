<?php

namespace App\Http\Controllers\Front;

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
  public function changeLanguage( Request $request)
    {

        $locale=$request->locale;

        Artisan::call('optimize:clear');
        session()->put('locale', $locale);
        App::setLocale($locale);

        $language = Language::where('code', $locale)->first();
        $url = url()->previous();
        flash(translate('تــم تغـييـر اللــغة الــي ').$language->name)->success();
        $data=LaravelLocalization::getLocalizedURL($locale,  $url, [], true) ;
        return $data;

    }
  public function changeToLanguage( $locale)
    {

        Artisan::call('optimize:clear');
    	        session()->put('locale', $locale);
        App::setLocale($locale);

        $language = Language::where('code', $locale)->first();
        $url = url()->previous();
        $route = app('router')
            ->getRoutes($url)
            ->match(app('request')->create($url))
            ->getName();
        flash(translate('تــم تغييـر اللــغة الــي ').$language->name)->success();
        return redirect(LaravelLocalization::getLocalizedURL($locale, route($route), [], true) );


    }

  public function changeGetLanguage( Request $request)
    {
                Artisan::call('optimize:clear');


        $language = Language::where('code', $request->local)->first();
         if(!empty($language)){
        App::setLocale($request->local);
        session()->put('locale', $request->local);
        $url = url()->previous();
        $route = app('router')
            ->getRoutes($url)
            ->match(app('request')->create($url))
            ->getName();
        flash(translate('تــم تغييـر اللــغة الـي ').$language->name)->success();
        return redirect(LaravelLocalization::getLocalizedURL($request->local, route($route), [], true) );
    }
         return redirect()->route('home');

    }

}
