<?php

namespace App\Http\Controllers\Admin\SettingManagement;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staffs = new Staff();
        $roles=Role::get();
        $sort_search = $request->search;
        $role_id=$request->role_id;
        if ($request->has('search') && !empty($request->search)){
            $staffs = $staffs->whereHas('user', function($q)use ($sort_search){
                $q->where('name','like', '%'.$sort_search.'%');
            });
        }
        if ($request->has('role_id')&& !empty($request->role_id) ){
            $staffs = $staffs->whereHas('role', function($q)use ($role_id){
                $q->where('id',$role_id);
            });
        }
        
        $staffs = $staffs->paginate(10);
        return view('backend.SettingManagement.staffs.index', compact('staffs','sort_search','roles','role_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.SettingManagement.staffs.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(User::where('email', $request->email)->first() == null){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->mobile;
            $user->whatsapp_phone=$request->whatsapp_phone;
            $user->user_type = "staff";
            $user->password = Hash::make($request->password);
            if($user->save()){
                $staff = new Staff;
                $staff->user_id = $user->id;
                $staff->role_id = $request->role_id;
                if($staff->save()){
                    flash(translate('Staff has been inserted successfully'))->success();
                    return redirect()->route('staffs.index');
                }
            }
        }

        flash(translate('البريد الالكتروني مستخدم بالفعل'))->error();
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
        $staff = Staff::findOrFail(decrypt($id));
        $roles = Role::all();
        return view('backend.SettingManagement.staffs.edit', compact('staff', 'roles'));
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
        $staff = Staff::findOrFail($id);
        $user = $staff->user;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->mobile;
        $user->whatsapp_phone=$request->whatsapp_phone;
        if(strlen($request->password) > 0){
            $user->password = Hash::make($request->password);
        }
        if($user->save()){
            $staff->role_id = $request->role_id;
            if($staff->save()){
                flash(translate('تم تحديث الموظفين بنجــاح'))->success();
                return redirect()->route('staffs.index');
            }
        }

        flash(translate('حــدث خطــأ مــا'))->error();
        return back();
    }
    public function foreign_official(Request $request)
    {
        if(Staff::where('national_id',$request->national_id)->where('id','!=',$request->staff_id)->count()==0){
            $staff = Staff::findOrFail($request->staff_id);
            $staff->national_id=json_encode($request->national_id);
            $staff->save();
            flash(translate('تم اضافة الموظف كمسؤل خرجية بالفعل '))->success();
            return back();
        }else{
            flash(translate('يوجد لهذة الجنسية مسؤل خارجية بالفعل'))->error();
            return back();
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  4
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

       if( Reservation::where('administrator_id',Staff::findOrFail($id)->user->id)->count()<1) {
           User::destroy(Staff::findOrFail($id)->user->id);

           if (Staff::destroy($id)) {
               return ['massage'=>translate('تم حــذف الموظفين بنجــاح'),'status'=>1];
           }
           return ['massage'=>translate('حــدث خطــأ مــا'),'status'=>0];


       }
        return ['massage'=>translate('يوجد حجز مع هذا العميل'),'status'=>0];
    }




        public function changeSeen(Request $request)
    {
        $staff = Staff::findOrFail($request->id);
        $staff->is_apper = $request->status;
            if ($staff->save()) {
                return 1;
            }else{
                return 0;

            }

    }
           public function changeBackSeen(Request $request)
    {
        $staff = Staff::findOrFail($request->id);
        $staff->apper_back = $request->status;
            if ($staff->save()) {
                return 1;
            }else{
                return 0;

            }

    }

    public function ourStaff(){
        $staffs = Staff::all();
        return view('frontend.staff',['staffs'=>$staffs]);
    }
    public function ban($id) {
        $user= User::findOrFail($id);

        if($user->banned == 1) {
            $user->banned = 0;
            flash(translate('تـم إلغــاء حظــر الموظف بنجـــاح'))->success();
        } else {
            $user->banned = 1;
            flash(translate('تــم حظـــر الموظف بنجـــاح'))->success();
        }

        $user->save();

        return back();
    }
}
