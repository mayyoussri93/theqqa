<?php

namespace App\Exports;

use App\Models\Cv;
use App\Models\Reservation;
use App\Models\Staff;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;


class TransactionsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    protected $is_out,$cv_name,$cv_type,$passport_key,$booking_status,$date,$selected_staff,$nationality_id,$occuption_id,$client_name,$client_nationality_id,$client_phone,$visa_worker_num,$sorting;
    function __construct($request) {
        $this->cv_type = $request['cv_type']??"";
        $this->passport_key =$request['passport_key']??"";
        $this->booking_status =$request['booking_status']??"";
        $this->date =$request['date']??"";
        $this->selected_staff =$request["selected_staff"]??"";
        $this->nationality_id =$request["nationality_id"]??"";
        $this->occuption_id=$request["occuption_id"]??"";
        $this->client_name=$request["client_name"]??"";
        $this->client_nationality_id=$request["client_nationality_id"]??"";
        $this->client_phone=$request["client_phone"]??"";
        $this->visa_worker_num=$request["visa_worker_num"]??"";
        $this->sorting= $request["sorting"]??null;
        $this->cv_name=$request["cv_name"]??null;
        $this->is_out=$request["is_out"]??0;




    }
    public function query()
    {



        $bookings =  Reservation::query()->with('user')->whereNull('deleted_at')->whereHas('contract', function ($q) {
            if($this->is_out == 0 or $this->is_out == 1) {
                $q->where('is_out', $this->is_out);
            }
        })->with(['user.customer','contract','cv.officeRelation','Adminstaff','cv.nationality','cv.recruitmentFormOccupation','cv.airport']);
        if (  $this->client_name != null) {
            $bookings = $bookings->whereHas('user', function ($q)  {
                $q->name($this->client_name);
            });
        }
        if ($this->client_phone != null) {
            $bookings = $bookings->whereHas('user', function ($q)  {
                $q->phone($this->client_phone);
            });
        }
        if ($this->client_nationality_id != null) {
            $bookings = $bookings->whereHas('user', function ($q)  {
                $q->whereHas('customer',  function ($q2)  {
                    $q2->where('national_identification_number', $this->client_nationality_id );

                });
            });
        }
        if ($this->nationality_id != null) {
            $bookings = $bookings->whereHas('cv', function ($q)  {
                $q->where('national_id', $this->nationality_id);
            });
        }
        if ($this->occuption_id != null) {
            $bookings = $bookings->whereHas('cv', function ($q) {
                $q->where('occuption_id', $this->occuption_id);
            });
        }
        if ($this->cv_name != null) {
            $cvs = Cv::where('cvs_name', 'like', '%' . $this->cv_name . '%')->pluck('id')->toArray();
            $bookings = $bookings->whereIn('cv_id', $cvs);
        }
        if ($this->passport_key != null) {
            $cvs = Cv::where('passport_id', 'like', '%' . $this->passport_key . '%')->pluck('id')->toArray();
            $bookings = $bookings->whereIn('cv_id', $cvs);
        }
        if ($this->booking_status != null && $this->booking_status[0]!= null ) {
            $bookings = $bookings->whereIn( 'status',$this->booking_status );
        }
        if ($this->selected_staff != null) {
            $bookings = $bookings->where('administrator_id', $this->selected_staff );
        }
        if ( $this->date != null) {
            $bookings = $bookings->whereHas('contract', function ($q)  {
                $q->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $this->date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $this->date)[1])));
            });
        }
        if ($this->cv_type != null) {
            $cvs = Cv::where('office', $this->cv_type)->pluck('id')->toArray();
            $bookings = $bookings->whereIn('cv_id', $cvs);
        }
        if ($this->visa_worker_num != null) {
            $bookings = $bookings->whereHas('contract', function ($q)  {
                $q->where('contract_visa_num', $this->visa_worker_num );
            });
        }
        return $bookings;
    }

    public function headings(): array
    {
        return
            ['اسم العميل','رقم الهوية','رقم التأشيرة', 'رقم عقد مساند', 'رقم جواز السفر','اسم العامل/ة','الجنسية',
                'المهنة','تاريخ الانشاء','المكتب','حالة العقد','المسوق','مدة التقديم'];
    }

    public function map($res): array
    {
        if($res->status==5 )
            $current_status= 'عقود غير معتمدة';
        elseif($res->status ==6)
            $current_status=   'اعتماد العقد';
        elseif($res->status ==7)
            $current_status= 'عقد جديد';
        elseif($res->status ==8)
            $current_status= 'مساند';
        elseif($res->status ==9)
            $current_status= 'التفويض';
        elseif($res->status ==10)
            $current_status= 'التفييز';
        elseif($res->status ==11)
            $current_status= 'التذكرة';
        elseif($res->status ==15)
            $current_status= 'تم الوصول';
        elseif($res->status ==13)
            $current_status= 'مرتجع';
        elseif($res->status ==14)
            $current_status=  'مرحلة الاجراءات';
        if(!empty($res->Adminstaff))
            $admin= $res->Adminstaff->name ;
        elseif ( $res->status == '2' or  $res->status == '1' )
            $admin= "لم يتم اختيار المندوب بعد";
        else
            $admin="تم مسح المندوب";
        if(!empty($res->contract->date_contract)){
            $date = \Carbon\Carbon::createFromFormat('m/d/Y', $res->contract->date_contract);

            $now = \Carbon\Carbon::now();
            $diff = $date->diffInDays($now);
            $days= $diff.' '.translate('يوم');}
        else{
            $days='--' ;
        }
        return [
                       $res->user->name??"--",
                       $res->user->customer->national_identification_number??'--',
                       $res->contract->contract_visa_num ,
                       $res->contract->musand_num,
                       $res->cv->passport_id??"--" ,
                       $res->cv->cvs_name??"--",
                       $res->cv->nationality->name??"--",
                       $res->cv->recruitmentFormOccupation->name??"--",
                       date('d-m-Y', strtotime($res->contract->created_at)),
                       $res->cv->officeRelation->name??'--',
                       $current_status,
                       $admin,
                       $days,
            
     
        ];
    }


}
