<?php

namespace App\Http\Controllers\Front;

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


    public function all_blog() {
        $blogs = Blog::where('status', 1)->orderBy('created_at', 'desc')->paginate(12);
        return view("frontend.blog", compact('blogs'));
    }

    public function blog_details($slug) {
        $blog = Blog::where('slug', $slug)->first();
        return view("frontend.blog.details", compact('blog'));
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