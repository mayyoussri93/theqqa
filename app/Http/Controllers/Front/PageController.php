<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageTranslation;
use Illuminate\Http\Request;


class PageController extends Controller
{


    public function show_custom_page($slug){
        $page = Page::where('slug', $slug)->first();
        if($page != null){
            return view('frontend.loading', compact('page'));
        }
        abort(404);
    }
    public function mobile_custom_page($slug){
        $page = Page::where('slug', $slug)->first();
        if($page != null){
            return view('frontend.m_custom_page', compact('page'));
        }
        abort(404);
    }
}
