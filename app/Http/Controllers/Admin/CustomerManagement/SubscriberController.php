<?php

namespace App\Http\Controllers\Admin\CustomerManagement;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::orderBy('created_at', 'desc')->paginate(15);
        return view('backend.CustomerManagement.subscribers.index', compact('subscribers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subscriber = Subscriber::where('email', $request->email)->first();
        if($subscriber == null){
            $subscriber = new Subscriber;
            $subscriber->email = $request->email;
            $subscriber->save();
            flash(translate('تم الاشتراك بنجــاح'))->success();
        }
        else{
            flash(translate('انت مشترك بالفعل'))->success();
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subscriber::destroy($id);
        flash(translate('تم حذف المشترك بنجاح'))->success();
        return redirect()->route('subscribers.index');
    }
}
