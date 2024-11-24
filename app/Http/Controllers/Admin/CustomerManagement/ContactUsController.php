<?php

namespace App\Http\Controllers\Admin\CustomerManagement;

use App\Http\Controllers\Controller;
use App\Message;
use App\Models\ContactUs;
use App\Models\CutactusExport;
use Auth;
use Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Yajra\DataTables\DataTables;

class  ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $date = null;
        $sort_search = null;
        $subject_status = null;
        $status =null;



        if ($request->ajax()) {
            {

                $countact= ContactUs::orderBy('created_at', 'desc');
//       dd($request);
                if ($request->search != null) {
                    $sort_search = $request->search;

                    $countact = $countact->where('name', 'like', '%' . $request->search . '%')->orWhere('phone', 'like', '%' . $request->search . '%');
                }

                if ($request->date  != null) {

                    $date =$request->date;
                    $countact = $countact->whereDate('contact_us.created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $date)[0])))->whereDate('contact_us.created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $date)[1])));
                }
                if ($request->status != null) {

                    $status = $request->status ;
                    $countact = $countact->status($status);
                }
                if ($request->subject_status != null) {
                    $subject_status = $request->subject_status ;

                    $countact = $countact->where('subject', 'like', '%' .$subject_status. '%');
                }
                $dataTables = $countact;
                return DataTables::of($dataTables)
                    ->addIndexColumn()
                    ->editColumn('name', function ($row) {
                        return $row->name;
                    })
                    ->editColumn('subject', function ($row) {
                        return $row->subject;
                    })
                    ->editColumn('phone', function ($row) {
                        return $row->phone;
                    })
                    ->editColumn('notes', function ($row) {
                        return $row->notes;
                    })

                    ->editColumn('created_at', function ($row) {
                        return date('d-m-Y', strtotime($row->created_at));
                    })
                    ->editColumn('status', function ($row) {
                        if ($row->status == 1)
                            return translate('تم التواصل');
                        elseif ($row->status == 0)
                            return translate(' لم يتم التواصل');
                    })

                    ->editColumn('actions', function ($row) {
                        $actions = '';

                        $actions = '       <div class="btn-group">
                                                        <button type="button" class="btn btn-light-secondary  text-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                        <div class="dropdown-menu">';

                        if (Auth::user()->user_type == 'admin' || in_array('15', json_decode(Auth::user()->staff->role->permissions))) {
                            $actions .= '<a href="javascript:void(0)" class="dropdown-item delete "  data-href="' . route('contact_us.destroy', $row->id) . '">' . translate('مسح') . '</a>';
                        }
                        $mass=$row->massage;
                        $actions .= ' <a href="javascript:void(0)" class="dropdown-item show_contact_us_details " data-msg="'.$mass.'" >' . translate('نص الرسالة') . '</a>';
                        if (Auth::user()->user_type == 'admin' || in_array('14', json_decode(Auth::user()->staff->role->permissions))) {
                            $actions .= '<a href="javascript:void(0)" class="dropdown-item reply_contact_us " data-name="'. $row->name.'" data-phone="'. $row->phone.'"  >' . translate('الرد على العميل') . '</a>';

                        }

                        if (Auth::user()->user_type == 'admin' || in_array('13', json_decode(Auth::user()->staff->role->permissions))){
                            if ($row->status == 0){
                                $actions .= '<a href="javascript:void(0)" class="dropdown-item  " data-id="'. $row->id.'" data-status="'. $row->status.'" onclick="change_status('.$row->id.','.$row->status.')" >' . translate('تغير حالة التواصل') . '</a>';
                            }}
                        $actions .= '  </div> </div>';
                        return $actions;
                    })
                    ->rawColumns(['name','notes', 'subject', 'phone', 'created_at', 'status', 'actions'])->make(true);
            }
        }
        return view('backend.CustomerManagement.contact_us.index',compact('date','sort_search','subject_status','status'));

    }
    public function export(){

        return Excel::download(new  CutactusExport(), 'customer.xlsx');
    }

    public function send(Request $request)
    {

        $user_phone=$request->phone;
        if(!empty($user_phone)) {
            sendSmsMassage($user_phone, $request->massage);
        }
        flash(translate('تــم إرســال الـــرد'))->success();
        return  back();
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

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'massage' => 'required',

        ]);
        if ($validator->passes()) {
            $conversation = new ContactUs();
            $conversation->name = $request->name;
            $conversation->email = $request->email;
            $conversation->subject = $request->subject;
            $conversation->phone = $request->phone;
            $conversation->massage = $request->massage;

            $conversation->save();
            return response()->json(['success'=>translate('تم ارسال طلبك بنجاح الى المسؤلين')]);

        }

        return response()->json(['error'=>$validator->errors()]);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conversation = ContactUs::findOrFail(decrypt($id));

        return view('backend.CustomerManagement.contact_us.show', compact('conversation'));
    }




    public function contact_us_change_status(Request $request)
    {
        $contact_us=ContactUs::find($request->id);

        if(!empty($contact_us)){

            if($request->status==0){
                $contact_us->status=1;

            }elseif($request->status==1){
                $contact_us->status=0;

            }
            $contact_us->notes=$request->notes;
            $contact_us->save();

            flash(translate('تم تغير الحالة بنجاح'))->success();
        }
        return redirect()->route('contact_us.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function admin_show($id)
    {
//        $conversation = Conversation::findOrFail(decrypt($id));
//        if ($conversation->sender_id == Auth::user()->id) {
//            $conversation->sender_viewed = 1;
//        }
//        elseif($conversation->receiver_id == Auth::user()->id) {
//            $conversation->receiver_viewed = 1;
//        }
//        $conversation->save();
//        return view('backend.support.conversations.show', compact('conversation'));
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

        if(ContactUs::destroy($id)){

            $msg=translate('تم الحذف بنجاح');
            return response()->json(['msg'=>$msg],200);
        }
    }
}
