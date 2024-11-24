<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BusinessSetting;
use App\Http\Requests\RecruitmentFormRequest;
use App\Models\Cv;
use App\Models\CvPreviousSponsor;
use App\Models\Nationality;
use App\Models\RecruitmentForm;
use App\Models\RecruitmentFormAge;
use App\Models\RecruitmentFormExperience;
use App\Models\RecruitmentFormOccupation;
use App\Models\RecruitmentFormReligion;
use App\Models\RequestTransferSponsorship;
use App\Models\Reservation;
use App\Models\Staff;
use App\Models\User;
use App\Utility\NotificationUtility;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Policy;
use Illuminate\Support\Facades\Artisan;
use auth;
use Illuminate\Support\Facades\Cache;

use Session;

class ReservationController extends Controller
{
    public function reservation_cv(Request $request)
    {

        if (auth::check()) {
            if (Auth::user()->user_type != 'admin') {
                if (!empty(Session::get('cv_id'))) {
                    $cvs = Cv::find(Session::get('cv_id'));
                    Session::forget('cv_id');
                    Session::forget('staff_id');
                } else {
                    $cvs = Cv::find($request->cv_id);
                }
                $check_count_reservation_status = Reservation::where('user_id', auth::user()->id)->whereNull('deleted_at')->whereIn('status', [1, 2, 3])->count();
                $check_count_reservation = Reservation::where('user_id', auth::user()->id)->whereNull('deleted_at')->count();

                if ($check_count_reservation_status < 1) {
                    if ($cvs->is_booking != 1 && $check_count_reservation < 5) {
                        //                    && $check_res == 0
                        $res = new Reservation();
                        $res->user_id = auth::user()->id;
                        $res->cv_id = $cvs->id;
                        $res->status = 2;
                        $res->code = env('ALPA_KEY') . $cvs->nationality->key_code . date('Ymd') . rand(10, 99);

                        $res->save();
                        $cvs->is_booking = 1;
                        $cvs->save();
                        NotificationUtility::set_notification(
                            "new_booking_cv",
                            "قام هذا العميل بطلب حجز لهذة السيرة الذاتيه رقم الحجز " . $res->code,
                            route('booking_cv_request.view', ['id' => $res->id]),
                            0,
                            Auth::user()->id,
                            'admin',
                            $res->id
                        );

                        return $res->id;
                    }
                    return 0;
                }
            }
            return 0;
        }

        return 2;
    }



    public function reservation_new_cv($id)
    {
        $check_res = Reservation::find($id);
        if (!empty($check_res)) {
            $cvs = Cv::find($check_res->cv_id);
            $cvs->is_booking = 0;
            $cvs->save();
            $check_res->deleted_by = auth::user()->id;
            $check_res->delete();
            $admin_phone=auth::user()->phone;
            $msg = " عزيزي العميل : تخطي الطلب الخاص بكم المدة المسموحة له في النظام والغاءه برقم جواز : " . $cvs->passport_id ;

            if(!empty($admin_phone)) {
                sendSmsMassage($admin_phone, $msg);

            }

        }
        return redirect()->route('clientIndex');
    }
    public function showCvs(Request $request)
    {

        Session::forget('cv_id');
        Session::forget('staff_id');
        $select_age = $request->age_id;
        $select_occupation = $request->occupation_id;
        $select_nationality = $request->nationality_id;
        $select_region = $request->region_id;

        $all_res = \App\Models\Reservation::whereIn('status', [4, 5, 6, 7,8,9,10,11,12,14,15])->whereNull('deleted_at')->whereNotNUll('cv_id')->pluck('cv_id');
        $all_ban_offices = \App\Models\Office::where('ban',1)->pluck('id')->toArray();
        $all_cvs = Cv::isRecruitment()->booking()->Rapid()->whereNotIn('id', $all_res)->with(['nationality','recruitmentFormOccupation','recruitmentFormReligion','recruitmentFormSocialStatus','nationality','recruitmentFormExperience','officeRelation'])->whereNotIn('office', $all_ban_offices)->orderBy('cv_rank','desc');


        // $all_cvs=Cv::isRecruitment()->sold()->whereNotIn('id',$all_res);
        if ($request->age_id != null) {
            $age_data = RecruitmentFormAge::find($select_age);
            $all_cvs = $all_cvs->whereBetween('age_id', [$age_data->min, $age_data->max]);
        }
        if ($request->occupation_id != null) {
            $all_cvs = $all_cvs->where('occuption_id', $select_occupation);
        }
        if ($request->nationality_id != null) {

            $all_cvs = $all_cvs->where('national_id', $select_nationality);
        }
        if ($request->region_id != null) {
            $all_cvs = $all_cvs->where('region_id', $select_region);
        }

        $all_cvs = $all_cvs->orderBy('is_booking', 'asc')->latest()->paginate(15)->appends(request()->query());
        //   $all_cvs = Cache::remember('cvs'. request()->page, 600, function ()use($all_cvs) {
        //     return $all_cvs->orderBy('is_booking', 'asc')->latest()->paginate(4);
        // });
        $cv_data =$all_cvs->pluck('cv_data_front');

        return view('frontend.reservation.all-workers', compact('all_cvs','cv_data', 'select_age', 'select_occupation', 'select_nationality', 'select_region'));
        //        }else{
        //            flash('ﻻ يمكنك انشاء طلب جديد الان يمكن متابعة طلبك او إلغاء السابق والبدأ فى طلب حجز جديد')->error();
        //
        //            return redirect()->route('home');
        //        }



    }
    public function showAllWorkers(Request $request, $id =null)
    {
        Session::forget('cv_id');
        Session::forget('staff_id');

        $all_res = \App\Models\Reservation::whereIn('status', [4, 5, 6, 7,8,9,10,11,12,14,15])->whereNull('deleted_at')->whereNotNUll('cv_id')->pluck('cv_id');
        $all_ban_offices = \App\Models\Office::where('ban',1)->pluck('id')->toArray();
        $cvs_filter = Cv::isRecruitment()->booking()->Rapid()->whereNotIn('id', $all_res)->with(['nationality','recruitmentFormOccupation','recruitmentFormReligion','recruitmentFormSocialStatus','nationality','recruitmentFormExperience','officeRelation'])->whereNotIn('office', $all_ban_offices)->orderBy('cv_rank','desc')
                ->FilterByAge($request->age)
                ->FilterByOccupation($request->job)
            ->FilterByNationality($request->nationality)
            ->FilterByExperience($request->experience)
        ->FilterByReligion($request->religion);
        $all_cvs=$cvs_filter->get();

        $cvs=$cvs_filter->paginate(12);
                   $current_page = $cvs->currentPage() ;
        $last_page =  $cvs->lastPage();


        if ($request->ajax()) {

            $returnHTML = view('frontend.reservation.reservation_worker.workers_page')
                ->with(['cvs' => $cvs])->render();
            return response()->json([
                'success' => true,
                'html' => $returnHTML,
                'current_page' => $current_page,
                'last_page' => $last_page,
//                'type'=>$type
            ]);
        }


        $ages = RecruitmentFormAge::get();
        $jobs = RecruitmentFormOccupation::get();
        $nationalities = Nationality::get();
        $experiences=RecruitmentFormExperience::get();
        $religions  =RecruitmentFormReligion::get();
        return view('frontend.reservation.reservation_worker.all-workers', [
            'ages' => $ages,
            'jobs' => $jobs,
            'nationalities' => $nationalities,
            'cvs' => $cvs,
            'current_page' => $current_page,
            'last_page' => $last_page,
            'all_cvs'=>$all_cvs,
'experiences'=>$experiences,
       'religions' =>$religions,


//            'country_id'=>$country_id,
            'id'=>$id,
        ]);
    }//end fun

    public function index()
    {
        return view('backend.recruitment_client.index');
    }
    public function successReservation($id)
    {

        $res_id = $id;
        //        if( $check_res ==0) {

        return    view('frontend.reservation.success-reservation', compact('res_id'));
        //        }else{
        //            flash('ﻻ يمكنك انشاء طلب جديد الان يمكن متابعة طلبك او إلغاء السابق والبدأ فى طلب حجز جديد')->error();
        //
        //            return redirect()->route('home');
        //        }


    }

    public function reservation_details($id)
    {
        $current_res = Reservation::find($id);
        return view('frontend.reservation.reservation_details', compact('current_res'));
    }


    public function navigationResRequest($id)
    {
        $current_res = Reservation::find($id);
        if (!empty($current_res)) {
            if ($current_res->status == 2) {
                //                $staffs = Staff::get();
                return redirect()->route('choose_customer_service', $id);
                //                return view('frontend.reservation.customer-service', compact('staffs'));
            } elseif ($current_res->status == 3) {
                $created = $current_res->created_at;
                $user = User::find($current_res->administrator_id);
                return redirect()->route('count_timer', $id);
                //                return view('frontend.reservation.timer', compact('user', 'created'));
            }
        }
        return redirect()->route('clientIndex');
    }
    //    public function uploadFile( )
    //    {
    //        $res_id= Reservation::where('user_id',auth::user()->id)->status('!=',6)->first()->id;
    //
    //        return view('frontend.reservation.upload_files',compact('res_id'));
    //
    //    }
    public function select_service($id)
    {


        $res_id = $id;
        $staffs = Staff::where('is_apper',1)->get();


        return view('frontend.reservation.customer-service', compact('staffs', 'res_id'));
    }
    public function select_service_cv()
    {
        if(Session::get('cv_id')!=null) {

            $cv_id = Session::get('cv_id');
            $staffs = Staff::where('is_apper', 1)->get();


            return view('frontend.reservation.customer-service', compact('staffs', 'cv_id'));
        }
//        return redirect()->route('');
        return redirect('/أستقدام-عاملتك');
    }
    public function select_service_save(Request $request)
    {


        $res = Reservation::find($request->rest_id);
        if (!empty($res)) {
            if (!empty($request->staff_name) && $res->administrator_id == null) {

                $res->administrator_id = $request->staff_name;
                $res->status = 3;
                $res->save();
                $user_admin = User::find($res->administrator_id);
                //from freelancer to client
                NotificationUtility::set_notification(
                    "change_booking_status",
                    "تم اسناد طلب حجز جديد لك",
                    route('booking_cv_request.view', ['id' => $res->id]),
                    $res->administrator_id,
                    Auth::user()->id,
                    'admin',
                    $res->id
                );
                $created = $res->created_at;
                $admin_phone = $user_admin->phone;
//                $msg =   " عزيزى الموظف  أ. " . $user_admin->name . " قام العميل " . auth::user()->name . "صاحب رقم الجوال " . auth::user()->phone . " \nبحجز السيرة الذاتية الاتية " . static_asset(json_decode($res->cv->images)[0]);
                $msg =  "يوجد لديكم حجز باسم ".auth::user()->name ."برقم جوال " .auth::user()->phone ;
                if(!empty($admin_phone)) {
                    sendSmsMassage($admin_phone, $msg);
                }
                $user_phone=auth::user()->phone;
                $msg ="عزيزي العميل : تم حجز  سيرة ذاتية جديدة بنجاح بواسطتكم .للمتابعة يرجى التواصل مع المندوب المسؤول عن الطلب الخاص بكم !";
                if(!empty($user_phone)) {
                    sendSmsMassage($user_phone, $msg);
                }

                return redirect()->route('count_timer', $res->id);
            }
        }
        return redirect()->route('clientIndex');
    }
    public function showSponsorCvs(Request $request, $id =null)
    {


        $cvs =CvPreviousSponsor::apperFront()->latest()->whereHas('contract.reservation.cv')
            ->FilterByAge($request->age)
            ->FilterByNationality($request->nationality)
            ->paginate(12);
        $current_page = $cvs->currentPage() ;
        $last_page =  $cvs->lastPage();

        if ($request->ajax()) {

            $returnHTML = view('frontend.reservation.reservation_sponsor_worker.workers_page')
                ->with(['cvs' => $cvs])->render();
            return response()->json([
                'success' => true,
                'html' => $returnHTML,
                'current_page' => $current_page,
                'last_page' => $last_page,
//                'type'=>$type
            ]);
        }


        $ages = RecruitmentFormAge::get();
        $jobs = RecruitmentFormOccupation::get();
        $nationalities = Nationality::get();

        return view('frontend.reservation.reservation_sponsor_worker.all-workers', [
            'ages' => $ages,
            'jobs' => $jobs,
            'nationalities' => $nationalities,
            'cvs' => $cvs,
            'current_page' => $current_page,
            'last_page' => $last_page,
//            'country_id'=>$country_id,
            'id'=>$id,
        ]);
    }//end fun

    public function chooseSponsorService(Request $request)
    {
        Session::forget(['sponsor_contract_id','sponsor_staff_name']);
        $cv_sponsorship_id = $request->cv_sponsorship_id;
        $staffs = Staff::where('is_apper',1)->get();
        return view('frontend.reservation.customer-service-sponsor', compact('staffs', 'cv_sponsorship_id'));
    }
    public function request_transfer_sponsorship(Request $request)
    {
        $request_transfer_sponsorship=  new  RequestTransferSponsorship();
        $request_transfer_sponsorship->cv_sponsorship_id=$request->cv_sponsorship_id;
        $request_transfer_sponsorship->sponsor_staff_id=$request->sponsor_staff_id;
        $request_transfer_sponsorship->user_id=auth::user()->id;
        $request_transfer_sponsorship->save();
      $CvPreviousSponsor=  CvPreviousSponsor::find($request->cv_sponsorship_id);
        $CvPreviousSponsor->apper_front=0;
        $CvPreviousSponsor->update();
        $user_admin = User::find($request->sponsor_staff_id);
        //from freelancer to client
        NotificationUtility::set_notification(
            "change_booking_status",
            "تم اسناد طلب نقل كفالة جديد لك",
            route('order_cvPrevious_sponsor.index'),
            $request->sponsor_staff_id,
            Auth::user()->id,
            'admin'
        );
        $admin_phone = $user_admin->phone;
        $msg =  "يوجد لديكم حجز باسم ".auth::user()->name ."برقم جوال " .auth::user()->phone ;
        if(!empty($admin_phone)) {
            sendSmsMassage($admin_phone, $msg);
        }
        $user_phone=auth::user()->phone;
        $msg ="عزيزي العميل : تم حجز  سيرة نقل كفالة  جديدة بنجاح بواسطتكم .للمتابعة يرجى التواصل مع المندوب المسؤول عن الطلب الخاص بكم !";
        if(!empty($user_phone)) {
            sendSmsMassage($user_phone, $msg);
        }
        return redirect()->route('clientIndex');
    }
    public function count_timer($id)
    {
        $res = Reservation::find($id);
        $res_id = $id;
        $created = $res->created_at;
        $user = User::find($res->administrator_id);
        return view('frontend.reservation.timer', compact('user', 'created', 'res_id'));
    }

    public function booking_expired(Request $request)
    {

        $res = Reservation::find($request->res_id);
        if (!in_array($res->status, [4, 5, 6])) {
            $cvs = Cv::find($res->cv_id);
            $cvs->is_booking = 0;
            $cvs->save();
            $user = User::find($res->administrator_id);
            //from client to administrator
            NotificationUtility::set_notification(
                "change_booking_status",
                $res->code . "لقد انتهت صلاحية الحجز رقم",
                route('cvs.edit', $res->cv_id),
                $res->administrator_id,
                Auth::user()->id,
                'admin',
                $res->id
            );
            NotificationUtility::set_notification(
                "change_booking_status",
                $res->code . "لقد انتهت صلاحية الحجز رقم",
                route('cvs.edit', $res->cv_id),
                0,
                Auth::user()->id,
                'admin',
                $res->id
            );
            NotificationUtility::set_notification(
                "change_booking_status",
                $res->code . " انتهت صلاحية الحجز رقم",
                route('user.booking_log'),
                Auth::user()->id,
                Auth::user()->id,
                'client',
                $res->id
            );
            $res->delete();
        }
        return 1;
    }

    public function uploadStoreFile(Request $request)
    {
        $res = Reservation::find($request->res_id);
        $files_upload = [];
        if ($request->hasFile('files_upload')) {
            foreach ($request->files_upload as $key => $photo) {
                $fil_name = $photo->store('uploads/reservation');
                $files_upload[] = $fil_name;
            }
        }
        $res->uploads = json_encode($files_upload);
        $res->status = 3;
        $res->save();
        NotificationUtility::set_notification(
            "updated_files_booking_cv",
            "قام هذا العميل برفع الملفات المطلوبة لحجز السيرة الذاتيه",
            route('booking_cv_request.view', ['id' => $res->id]),
            0,
            Auth::user()->id,
            'admin',
            $res->id
        );
        $uploaded = 1;
        return view('frontend.reservation.complete_contract', compact('uploaded'));
    }

    public function viewRecruitmentForm()
    {
        return view('frontend.recruitment-request');
    }




    public function destroy($id)
    {

        RecruitmentForm::destroy($id);
        flash('تم مسح طلب الاستقدام بنجاح')->success();
        return redirect()->route('clientIndex');
        // return redirect()->route('recruitment_form_request.index');

    }
    public function set_reservation_session(Request $request)
    {
        if (!auth::check()) {
            Session::put('cv_id', $request->cv_id);
        }
        return 1;
    }
    public function getClientsInfo(Request $request)
    {
        $input = $request->all();
        $data = Reservation::join('users', 'rservations.user_id', 'users.id')
            ->where('rservations.status', $input['status'])
            ->select('rservations.user_id as user_id', 'users.name as name')
            ->get()
            ->toArray();
        return response()->json($data);
    }


    //updates the policy pages

}