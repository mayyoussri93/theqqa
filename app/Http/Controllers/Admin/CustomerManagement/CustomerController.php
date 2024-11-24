<?php

namespace App\Http\Controllers\Admin\CustomerManagement;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\RecruitmentForm;
use App\Models\Reservation;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search = $request->sort_search;
        $date_range = $request->date_range;
        $status = $request->status;
        if ($request->ajax()) {
            $customers = Customer::orderBy('created_at', 'desc');
            if ($request->has('sort_search')) {
                $sort_search = $request->sort_search;
                $user_ids = User::where('user_type', 'customer')->where(function ($user) use ($sort_search) {
                    $user->where('name', 'like', '%' . $sort_search . '%')->orWhere('phone', 'like', '%' . $sort_search . '%');
                })->pluck('id')->toArray();
                $customers = $customers->where(function ($customer) use ($user_ids) {
                    $customer->whereIn('user_id', $user_ids);
                });
            }
            if ($request->status) {
                $user_ids2 = Reservation::whereHas('user')->pluck('user_id')->toArray();
                if ($request->status == 1) {
                    $customers = $customers->where(function ($customer) use ($user_ids2) {
                        $customer->whereIn('user_id', $user_ids2);
                    });

                } else if ($request->status == 2) {
                    $customers = $customers->where(function ($customer) use ($user_ids2) {
                        $customer->whereNotIn('user_id', $user_ids2);
                    });
                }
            }

            if ($request->date_range) {
                $date_range1 = explode(" - ", $request->date_range);
                $start = date('Y-m-d', strtotime($date_range1[0]));
                $end = date('Y-m-d', strtotime($date_range1[1]));
                $customers = $customers->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end);
            }
            $dataTables = $customers->has('user');
            return DataTables::of($dataTables)
                ->addIndexColumn()
                ->addColumn('choose', function ($row) {
                    return ' <div class="n-chk align-self-center text-center"><div class="form-check"><input type="checkbox" class="form-check-input contact-chkbox primary"
                                                       id="'.'checkbox'.$row->id.'" name="id[]" value="'.$row->id.'">
                                                <label class="form-check-label" for="'.'checkbox'.$row->id.'"></label>
                                            </div>
                                        </div>';

                })
                ->editColumn('user_status', function ($row) {
                    $customer = Customer::findOrFail($row->id);
                    if($customer->user->banned == 1)

                        return '<span class="badge bg-orange text-white fw-normal">'.translate('معلق').'</span>';
                    else
                        return '<span class="badge bg-success  fw-normal">'.translate('غير معلق').' </span>';
                })
                ->editColumn('phone', function ($row) {
                    return $row->user->phone;
                })
                ->editColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at;
                })
                ->editColumn('status', function ($row) {
                    if(Reservation::where('user_id',$row->user->id)->count() > 0)
                        return '<span class="badge bg-orange text-white fw-normal">'.translate('يوجد حجز').'</span>';
                    else
                        return '<span class="badge bg-success  fw-normal">'.translate('ﻻ يوجد حجز').' </span>';
                })
                ->editColumn('actions', function ($row) {
                    $actions = '       <div class="btn-group">
                                                        <button type="button" class="btn btn-light-secondary text-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                        <div class="dropdown-menu">';


                    if(Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions))) {
                        $action=!empty(\App\Models\Customer::where('user_id', $row->user->id)->first()) ? route('customers.edit', \App\Models\Customer::where('user_id', $row->user->id)->first()->id) : '#' ;
                        $actions .= '<a href="'.$action.'" title="' . translate('تعديل') . '" class="dropdown-item">' . translate('تعديل') . '</a>';
                    }
                    if(Auth::user()->user_type == 'admin' || in_array('149', json_decode(Auth::user()->staff->role->permissions))) {
                      if(Reservation::where('user_id',$row->user->id)->count() == 0){

                        $action=route('customers.ban',$row->id) ;
                        $customer = Customer::findOrFail($row->id);
                        if($customer->user->banned == 1) {
                            $actions .= '<a href="' . $action . '" title="' . translate('اللغاء تعليق') . '" class="dropdown-item">' . translate('اللغاء تعليق') . '</a>';
                        }else{
                            $actions .= '<a href="' . $action . '" title="' . translate('تعليق') . '" class="dropdown-item">' . translate('تعليق') . '</a>';
                        }
                      }
                    }
                    $customer = Customer::findOrFail($row->id);
                    if((Auth::user()->user_type == 'admin' || in_array('55', json_decode(Auth::user()->staff->role->permissions))) && $customer->user->banned != 1) {
                        $actions .= '<a href="#" class="dropdown-item" onclick="reservation_user('.$row->user->id.');">' . translate('حجز سيرة') . '</a>';
                    }

                    if(Auth::user()->user_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions))) {
                        $actions .= '<a href="javascript:void(0)" class="dropdown-item delete"  data-href="'.route('customers.destroy', $row->id).'">' . translate('مسح') . '</a>';
                    }
                    if(Auth::user()->user_type == 'admin' || in_array('126', json_decode(Auth::user()->staff->role->permissions))) {
                        $action=!empty($row->user->id)?route('massage.list', $row->user->id):'#';
                        $actions .= '<a href="'.$action.'" title="' . translate('الرسائل المرسلة') . '" class="dropdown-item">' . translate('الرسائل المرسلة') . '</a>';
                    }
  if(Auth::user()->user_type == 'admin' || in_array('236', json_decode(Auth::user()->staff->role->permissions))){
                      $actions.=' <a  href="#" onclick="send_sms(' . $row->user->id . ')" class="dropdown-item">' . translate('ارسال رساله للعميل') . '</a>';

                        }

                    $actions .= '  </div> </div>';

                    return $actions;
                })
                ->rawColumns(['name','choose', 'phone','user_status', 'created_at', 'status', 'actions','sort_search','date_range','status'])->make(true);
        }
        return view('backend.CustomerManagement.customer.index', compact( 'sort_search','date_range','status'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.CustomerManagement.customer.create');

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
            'name'          => 'required',
            'password' => 'required|confirmed|min:6',
            'phone'         => 'required|unique:users,phone,',
        ]);
        $user =new User();

        $user->name = $request->name;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->phone = $request->phone;
        $user->save();
        $customer = new Customer;
        $customer->link=$request->link;
        $customer->user_id = $user->id;
        $customer->save();
        if($request->password != null && ($request->password == $request->confirm_password)){
            $user->password = Hash::make($request->password);
        }
        $user->avatar_original = $request->photo;

        if($user->save()){
            flash(translate('تم تحديث ملف تعريف العميل بنجاح!'))->success();
            return redirect()->route('customers.index');
        }

        flash(translate('عفوا ! حدث خطـــأ مــا'))->error();
        return redirect()->route('customers.index');


        $request->validate([
            'name'          => 'required',
            'link'         => 'required',
        ]);

        $response['status'] = 'Error';

        $user = User::create($request->all());

        $customer = new Customer;
        $customer->link=$request->link;
        $customer->user_id = $user->id;
        $customer->save();

        if($user->save()){
            flash(translate('تـم إدخال بيــانــات ملــف العميـــل بنجـــاح'))->success();
            return redirect()->route('customers.index');
        }

        flash(translate('عــفـوا ! حــدث خطـــأ مــا'))->error();
        return redirect()->route('customers.index');
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

        $customer = Customer::findOrFail($id);

        return view('backend.CustomerManagement.customer.edit', compact('customer'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user = Customer::findOrFail($request->customer_id)->user;

        $user->name = $request->name;
        $user->address = $request->address;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->postal_code = $request->postal_code;
        $user->phone = $request->phone;
        $customer =   Customer::findOrFail($request->customer_id);

        $customer->link=$request->link;
        $customer->save();
        if($request->new_password != null && ($request->new_password == $request->confirm_password)){
            $user->password = Hash::make($request->new_password);
        }
        $user->avatar_original = $request->photo;

        if($user->save()){
            flash(translate('تــم تحــديــث بيــانــات العمـــيل بنجـــاح'))->success();
            return redirect()->route('customers.index');
        }

        flash(translate('عفــوا ! حـــدث خطــــأ مـــا'))->error();
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

$user_id=Customer::findOrFail($id)->user->id;
        if(  Reservation::where('user_id',$user_id)->count() == 0 && RecruitmentForm::where('user_id',$user_id)->count() ==0) {
            User::destroy(Customer::findOrFail($id)->user->id);
            if (Customer::destroy($id)) {

                $msg=translate('تم الحذف بنجاح');
                return response()->json(['msg'=>$msg],200);
            }


            $msg=translate('عـفــوا ! حــدث خطـــأ مــا');
            return response()->json(['msg'=>$msg],200);
        }else{
            $msg="لم يمكن مسح هذاالعميل بسبب وجود حجز عماله او حجز عماله خاص";
            return response()->json(['msg'=>$msg],200);

        }
    }

    public function bulk_customer_delete(Request $request) {
        if(explode(',',$request->ids)) {
            foreach (explode(',',$request->ids) as $customer_id) {
                $user_id=Customer::findOrFail($customer_id)->user->id;
                if(  Reservation::where('user_id',$user_id)->count() == 0 && RecruitmentForm::where('user_id',$user_id)->count() ==0) {
                    User::destroy($user_id);
                    Customer::destroy($customer_id);
                }
            }
            return 1;
        }

        return 0;
    }
    public function bulk_customer_ban(Request $request) {
        if(explode(',',$request->ids)) {
            foreach (explode(',',$request->ids) as $customer_id) {
                $customer = Customer::findOrFail($customer_id);

                if($customer->user->banned == 1) {
                    $customer->user->banned = 0;
                    flash(translate('تــم إلغــاء حظــر العمــيل بنجـــاح'))->success();
                } else {
                    $customer->user->banned = 1;
                    flash(translate('تـم حظــر العمـــيل بنجـــاح'))->success();
                }

                $customer->user->save();
            }
            return 1;
        }

        return 0;
    }


    public function login($id)
    {
        $customer = Customer::findOrFail(decrypt($id));

        $user  = $customer->user;

        auth()->login($user, true);

        return redirect()->route('dashboard');
    }

    public function ban($id) {
        $customer = Customer::findOrFail($id);

        if($customer->user->banned == 1) {
            $customer->user->banned = 0;
            flash(translate('تـم إلغــاء حظــر العمـــيل بنجـــاح'))->success();
        } else {
            $customer->user->banned = 1;
            flash(translate('تــم حظـــر العمـــيل بنجـــاح'))->success();
        }

        $customer->user->save();

        return back();
    }
}
