<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Comment;
use App\Models\CommentReply;
use App\Utility\NotificationUtility;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = null;
        $blogs = Blog::orderBy('created_at', 'desc');

        if ($request->search != null){
            $blogs = $blogs->where('title', 'like', '%'.$request->search.'%');
            $sort_search = $request->search;
        }

        $blogs = $blogs->paginate(15)->appends(request()->query());

        return view('backend.SettingManagement.other_pages.blog_system.blog.index', compact('blogs','sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $blog_categories = BlogCategory::all();
        return view('backend.SettingManagement.other_pages.blog_system.blog.create', compact('blog_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
//            'category_id' => 'required',
            'title' => 'required|max:255',
        ]);

        $blog = new Blog;
        $tags = array();
//        if ($request->tags[0] != null) {
//            foreach (json_decode($request->tags[0]) as $key => $tag) {
//                array_push($tags, $tag->value);
//            }
//        }
        $blog->tags = implode(',', $tags);

        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->banner = $request->banner;
        $blog->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
//        $blog->short_description = $request->short_description;
        $blog->description = $request->description;

        $blog->meta_title = $request->meta_title;
        $blog->meta_img = $request->meta_img;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;

        $blog->save();

        flash(translate('تم إنشاء منشور المدونة بنجاح'))->success();
        return redirect()->route('website.other_pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        $blog_categories = BlogCategory::all();
        $tags = json_decode($blog->tags);
        return view('backend.SettingManagement.other_pages.blog_system.blog.edit', compact('blog','blog_categories','tags'));
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
        $request->validate([
//            'category_id' => 'required',
            'title' => 'required|max:255',
        ]);

        $blog = Blog::find($id);
        $tags = array();
//        if($request->tags[0] != null){
//            foreach (json_decode($request->tags[0]) as $key => $tag) {
//                array_push($tags, $tag->value);
//            }
//        }
        $blog->tags           = implode(',', $tags);

        $blog->category_id = $request->category_id;
        $blog->title = $request->title;
        $blog->banner = $request->banner;
        $blog->slug = preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $request->slug));
//        $blog->short_description = $request->short_description;
        $blog->description = $request->description;

        $blog->meta_title = $request->meta_title;
        $blog->meta_img = $request->meta_img;
        $blog->meta_description = $request->meta_description;
        $blog->meta_keywords = $request->meta_keywords;

        $blog->save();

        flash(translate('تم تحديث منشور المدونة بنجاح'))->success();
        return redirect()->route('website.other_pages');

    }

    public function change_status(Request $request) {
        $blog = Blog::find($request->id);
        $blog->status = $request->status;

        $blog->save();
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::find($id)->delete();
        flash(translate('تم حذف منشور المدونة بنجاح'))->success();

        return redirect()->route('website.other_pages');

    }


    public function all_blog() {
        $blogs = Blog::where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
        return view("frontend.blog", compact('blogs'));
    }

    public function blog_details($slug) {
        $blog = Blog::where('slug', $slug)->first();
        return view("frontend.blog.details", compact('blog'));
    }

    public function seach(Request $request)
    {

        $tag_search = null;
        $cat_id_search=null;
        $check_search=null;
        $blogs = Blog::orderBy('created_at', 'desc');

        if ($request->tag != null){
            $blogs = $blogs->where('tags', 'like', '%'.$request->tag.'%');
            $tag_search = $request->tag;
        }
        if ($request->cat_id != null){
            $blogs = $blogs->where('category_id',$request->cat_id);
            $cat_id_search = $request->tag;
        }
        if ($request->check != null){
            $check_search = $request->check;
            if($check_search ==1){
                $blogs = $blogs->latest;
            }elseif ($check_search ==2){
                $blogs = $blogs->whereHas('commment');
            }elseif ($check_search ==3){
                $blogs = $blogs->orderBy('count_views', 'desc');
            }
        }
        $blogs = $blogs->paginate(15)->appends(request()->query());


        return view('frontend.tag', compact('blogs','tag_search','cat_id_search','check_search'));
    }
    public function article_details($id)
    {
        $blog=Blog::find($id);
        return view('frontend.article-details', compact('blog'));

    }
    public function blog_comment_send(Request $request)
    {
        $ticket = new Comment();
        $ticket->name =$request->name;
        $ticket->email = $request->email;
        $ticket->details = $request->details;
        $ticket->blog_id = $request->blog_id;
        if (!Auth::check() && Auth::user()->user_type != 'admin' && Auth::user()->user_type != 'staff') {
            NotificationUtility::set_notification(
                "new_comment",
                "قام " . $request->name . " بكتابة تعليق على المنشور",
                route('article.details', [$request->blog_id]),
                0,
                'guest',
                'admin',
                null
            );
        }
        if($ticket->save()){

            flash(translate('تم ارسال تعليقك'))->success();
            return back();
        }
        else{
            flash(translate('حـدث شـئ خــاطئ'))->error();
            return back();
        }
    }
    public function blog_comment_reply(Request $request)
    {
        $ticket = new CommentReply();
        $ticket->name =$request->name;
        $ticket->email = $request->email;
        $ticket->reply = $request->details;
        $ticket->comment_id = $request->comment_id;

        if($ticket->save()){

            flash(translate('تم ارسال تعليقك'))->success();
            return back();
        }
        else{
            flash(translate('حـدث شـئ خــاطئ'))->error();
            return back();
        }
    }

    public function CountViewBlog($id )
    {

        $feq_ques =  Blog::find($id);
        $feq_ques->count_views +=1;
        $feq_ques->save();
        return 1;
    }

}