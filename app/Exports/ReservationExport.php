<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\Cv;
use App\Models\Office;
use App\Models\Reservation;
use App\Models\Staff;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use auth;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Maatwebsite\Excel\Concerns\WithDefaultStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithBackgroundColor;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;


class ReservationExport implements FromCollection, WithMapping, WithHeadings,WithDrawings,ShouldAutoSize,WithStyles,WithColumnWidths
{
    public function columnWidths(): array
    {
        return [
            'A' => 20,

        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],

        ];
    }
    public function drawings()
    {
        $drawing = new Drawing();
        $drawing->setPath(public_path('/v3_assets/img/logo.svg'));
        $drawing->setHeight(80);
        $drawing->setOffsetX(20);
        $drawing->setOffsety(20);
        $drawing->setShadow();




        return $drawing;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $cv_type,$passport_key,$booking_status,$date,$selected_staff,$nationality_id,$occuption_id,$client_name,$client_nationality_id,$client_phone,$visa_worker_num,$guarantee_status;


    function __construct($request) {
        $this->cv_type = $request->cv_type?$request->cv_type:"";
        $this->passport_key =$request->passport_key?$request->passport_key:"";
        $this->booking_status =$request->booking_status?$request->booking_status:"";
        $this->date =$request->date?$request->date:"";
        $this->selected_staff =$request->selected_staff?$request->selected_staff:"";
        $this->nationality_id =$request->nationality_id?$request->nationality_id:"";
        $this->occuption_id=$request->occuption_id?$request->occuption_id:"";
        $this->client_name=$request->client_name?$request->client_name:"";
        $this->client_nationality_id=$request->client_nationality_id?$request->client_nationality_id:"";
        $this->client_phone=$request->client_phone?$request->client_phone:"";
        $this->visa_worker_num=$request->visa_worker_num?$request->visa_worker_num:"";
        $this->guarantee_status=$request->guarantee_status?$request->guarantee_status:"";

    }
    public function collection()
    {  $bookings = Reservation::whereNull('deleted_at')->latest()->with(['user.customer','contract','cv.officeRelation','Adminstaff','cv.nationality','cv.recruitmentFormOccupation','cv.airport']);
        if (Auth::user()->user_type == 'admin' || in_array('128', json_decode(Auth::user()->staff->role->permissions)) || Staff::where('user_id', auth::user()->id)->first()->role_id == 5) {
            $bookings;
        } else {
            $bookings = $bookings->where('administrator_id', auth::user()->id);
        }
        if ($this->client_name != null) {
            $bookings = $bookings->withWhereHas('user', function ($q)  {
                $q->where('name', 'like', '%' . $this->client_name . '%')->orwhere('phone', 'like', '%' . $this->client_name . '%');
            });
        }
//        if($this->client_phone != null) {
//            $bookings=$bookings->whereHas('user', function ($q) use ($client_phone){
//                $q->where('phone','like', '%'.$client_phone.'%');
//            });
//        }
        if ($this->nationality_id != null) {
            $bookings = $bookings->withWhereHas('cv', function ($q)  {
                $q->where('national_id', $this->nationality_id);
            });
        }
        if ($this->occuption_id != null) {
            $bookings = $bookings->withWhereHas('cv', function ($q)  {
                $q->where('occuption_id', $this->occuption_id);
            });
        }
        if ($this->passport_key != null) {
            $cvs = Cv::where('passport_id', 'like', '%' . $this->passport_key . '%')->pluck('id')->toArray();

            $bookings = $bookings->whereIn('cv_id', $cvs);
        }
        if ($this->booking_status != null) {
            $bookings = $bookings->status( $this->booking_status);
        }
        if ($this->selected_staff != null) {
            $bookings = $bookings->where('administrator_id', $this->selected_staff );
        }
        if ($this->date != null) {
            $bookings = $bookings->whereDate('rservations.created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $this->date)[0])))->whereDate('rservations.created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $this->date)[1])));
        }
        if ($this->cv_type != null) {
            $cvs = Cv::where('office', $this->cv_type)->pluck('id')->toArray();
            $bookings = $bookings->whereIn('cv_id', $cvs);
        }
        $dataTables = $bookings->has('user')->has('cv');

        return $bookings->get();
    }
    public function headings(): array
    {


        return ['اسم العميل', 'هاتف العميل','المكتب','رقم جواز السفر','تاريخ اضافة الطلب','مسؤل الطلب','حالة الطلب'];
    }
    public function map($res): array
    {
        if(Auth::user()->user_type == 'admin' || in_array('200', json_decode(Auth::user()->staff->role->permissions))) {

          $user_phone= $res->user->phone;
        }else{
            $user_phone= '--';
        }

        if (!empty($res->Adminstaff)&&!empty($res->Adminstaff->staff)) {
            $admin=  $res->Adminstaff->name ;
        }elseif ($res->status == '2' or $res->status == '1'){
            $admin="لم يتم اختيار المندوب بعد" ;
        }else{
            $admin="تم مسح المندوب";
        }
        $booking_status=$res->status;
        if ($booking_status == '2')
            $check_status='تم اختيار السيرة';
        elseif($booking_status == '3')
            $check_status='تم اختيار احد المندوبين';
        elseif($booking_status == '4')
            if (!empty($res->contract)) {
                $check_status='تم التعاقد مع العميل - يوجد عقد';
            }else{
                $check_status='تم التعاقد مع العميل - ﻻ يوجد عقد';
            }
        elseif($booking_status ==5 )
            $check_status='عقود غير معتمدة';
        elseif($booking_status  ==6)
            $check_status='اعتماد العقد';
        elseif($booking_status  ==7)
            $check_status='عقد جديد';
        elseif($booking_status  ==8)
            $check_status='مساند';
        elseif($booking_status  ==9)
            $check_status='التفويض';
        elseif($booking_status  ==10)
            $check_status='التفييز';
        elseif($booking_status  ==11)
            $check_status='التذكرة';
        elseif($booking_status  ==12)
            $check_status='تحت الضمان';
        elseif($booking_status ==13)
            $check_status='مرتجع ';
        elseif($booking_status  ==14)
            $check_status='مرحلة الاجراءات';
        elseif($booking_status  ==15)
            $check_status='مرحلة الوصول';
        return [
            $res->user->name,
            $user_phone,
            $res->cv->officeRelation->name??"--",
            $res->cv->passport_id??"--",
            date('Y/m/d',strtotime($res->created_at)),
            $admin,
            $check_status,



        ];
    }
}
