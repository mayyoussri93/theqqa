<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\Cv;
use App\Models\CvPreviousSponsor;
use App\Models\Reservation;
use App\Models\ReservationSponsor;
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


class ArrivedContractExport implements FromCollection, WithMapping, WithHeadings,WithDrawings,ShouldAutoSize,WithStyles,WithColumnWidths
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
    protected $cvs_name,$arrived_status,$cv_type,$passport_key,$booking_status,$date,$selected_staff,$nationality_id,$occuption_id,$client_name,$client_nationality_id,$client_phone,$visa_worker_num,$guarantee_status;


    function __construct($request) {
        $this->cv_type = $request->cv_type?$request->cv_type:"";
        $this->passport_key =$request->passport_key?$request->passport_key:"";
        $this->cvs_name =$request->cvs_name?$request->cvs_name:"";
        $this->booking_status =$request->booking_status?$request->booking_status:"";
        $this->date =$request->date?$request->date:"";
        $this->selected_staff =$request->selected_staff?$request->selected_staff:"";
        $this->nationality_id =$request->nationality_id?$request->nationality_id:"";
        $this->occuption_id=$request->occuption_id?$request->occuption_id:"";
        $this->client_name=$request->client_name?$request->client_name:"";
        $this->client_nationality_id=$request->client_nationality_id?$request->client_nationality_id:"";
        $this->client_phone=$request->client_phone?$request->client_phone:"";
        $this->visa_worker_num=$request->visa_worker_num?$request->visa_worker_num:"";
        $this->arrived_status=$request->arrived_status?$request->arrived_status:"";
        $this->guarantee_status=$request->guarantee_status?$request->guarantee_status:"";
    }
    public function collection()
    {
        $bookings = Reservation::whereNull('deleted_at')->whereHas('contract')->with(['user.customer','contract','cv.officeRelation','Adminstaff','cv.nationality','cv.recruitmentFormOccupation','cv.airport'])->status(15)->latest();

        if (Auth::user()->user_type == 'admin'  || in_array('181', json_decode(Auth::user()->staff->role->permissions))|| Staff::where('user_id', auth::user()->id)->first()->role_id == 5) {
            $bookings = $bookings;
        } else {
            $bookings = $bookings->where('administrator_id', auth::user()->id);
        }

        if ($this->client_name != null) {
            $bookings = $bookings->whereHas('user', function ($q)  {
                $q->name($this->client_name);
            });
        }
        if ($this->client_phone != null) {
            $bookings = $bookings->whereHas('user', function ($q) {
                $q->phone($this->client_phone );
            });
        }

        if ($this->client_nationality_id != null) {
            $bookings = $bookings->whereHas('user', function ($q)  {
                $q->whereHas('customer',  function ($q2) {
                    $q2->where('national_identification_number', $this->client_nationality_id );

                });
            });
        }
        if ($this->guarantee_status != null) {
            $now = \Carbon\Carbon::now();
            if($this->guarantee_status == 1) {
                $bookings = $bookings->whereHas('cv', function ($q) use ($now) {
                    $q->where('expired_date', '>=', $now);

                });
            }elseif($this->guarantee_status == 2){
                $bookings = $bookings->whereHas('cv', function ($q) use ($now) {
                    $q->where('expired_date', '<', $now);

                });
            }

        }

        if ($this->nationality_id != null) {
            $bookings = $bookings->whereHas('cv', function ($q){
                $q->where('national_id', $this->nationality_id);
            });
        }
        if ($this->occuption_id != null) {
            $bookings = $bookings->whereHas('cv', function ($q) {
                $q->where('occuption_id', $this->occuption_id);
            });
        }
        if ($this->passport_key != null) {
            $cvs = Cv::where('passport_id', 'like', '%' . $this->passport_key . '%')->pluck('id')->toArray();
            $bookings = $bookings->whereIn('cv_id', $cvs);
        }
        if ($this->cvs_name != null) {
            $cvs = Cv::where('cvs_name', 'like', '%' . $this->cvs_name . '%')->pluck('id')->toArray();
            $bookings = $bookings->whereIn('cvs_name', $cvs);
        }
        if ($this->booking_status != null) {
            $bookings = $bookings->status( $this->booking_status );
        }
        if ($this->selected_staff != null) {
            $bookings = $bookings->where('administrator_id', $this->selected_staff);
        }
        if ($this->date != null) {

            $bookings = $bookings->whereHas('cv', function ($q) {
                $q->whereDate('arrived_date', '>=', date('Y-m-d', strtotime(explode(" - ", $this->date)[0])))->whereDate('arrived_date', '<=', date('Y-m-d', strtotime(explode(" - ", $this->date)[1])));
            });
        }
        if ($this->cv_type != null) {
            $cvs = Cv::where('office', $this->cv_type)->pluck('id')->toArray();
            $bookings = $bookings->whereIn('cv_id', $cvs);
        }
        if ($this->visa_worker_num != null) {
            $bookings = $bookings->whereHas('contract', function ($q) {
                $q->where('contract_visa_num', $this->visa_worker_num);
            });
        }

        if ($this->arrived_status != null) {
            $contract_array_1=ReservationSponsor::pluck('contract_id')->toArray();
            $contract_array_2=CvPreviousSponsor::pluck('contract_id')->toArray();
            $contract_array_merge=array_merge($contract_array_1,$contract_array_2);
            if($this->arrived_status==1){
                $bookings = $bookings->whereHas('contract', function ($q) use ($contract_array_merge) {
                    $q->whereNotIn('id', $contract_array_merge);
                });
            }
            elseif ($this->arrived_status==2){
                $bookings = $bookings->whereHas('contract', function ($q) use ($contract_array_merge) {
                    $q->whereIn('id', $contract_array_merge);
                });
            }
        }

        return $bookings->get();
    }
    public function headings(): array
    {

        return
        ['اسم العميل','رقم هوية العميل','الهاتف','رقم التأشيرة','الجنسية', 'رقم جواز السفر','اسم العامل/ة','المكتب','حالة الضمان','المسوق','تاريخ العقد','تاريخ الوصول','مطار الوصول','مدة الضمان','انتهاء الضمان','المتبقى','مدة الوصول'];
    }
    public function map($res): array
    {

        if(!empty($res->cv->expired_date)) {
            $date_arrive = \Carbon\Carbon::parse($res->cv->expired_date);
        }else{
            $date_arrive = \Carbon\Carbon::parse($res->cv->date_contract);

        }
        $now = \Carbon\Carbon::now();


        if( $date_arrive->gt($now) == true ) {
          $check_status=  'فى الضمان';
        }else {
            $check_status= 'خارج الضمان';

        }

        if(!empty($res->Adminstaff))
            $admin= $res->Adminstaff->name ;
        elseif ( $res->status == '2' or  $res->status == '1' )
            $admin= "لم يتم اختيار المندوب بعد";
        else
            $admin="تم مسح المندوب";

        $residual = $date_arrive->diffInDays($now);
        if( $date_arrive->gt($now) == true ) {

             $residual;
        }else{
            $residual= '-'.$residual;
        }

        if(!empty($res->contract->date_contract)) {
            $diff = \Carbon\Carbon::parse($res->cv->arrived_date)->diffInDays(\Carbon\Carbon::parse($res->contract->date_contract));
        }else{
            $diff = \Carbon\Carbon::parse($res->cv->arrived_date)->diffInDays(\Carbon\Carbon::parse($res->contract->created_at));

        }

            if(!empty($res->cv->expired_date)){
             $expired =    $res->cv->expired_date;
            }else{
                $expired =    "--";

            }
        return [

            $res->user->name,
            $res->user->customer->national_identification_number,
            $res->user->phone,
            $res->contract->contract_visa_num,
            $res->cv->nationality->name??"--",
            $res->cv->passport_id??"--",
            $res->cv->cvs_name??"--",
            $res->cv->officeRelation->name??"--",
            $check_status,
            $admin,
            $res->contract->date_contract,
            $res->cv->arrived_date,
            \App\Models\Airport::find($res->cv->airport_id)->name??"--",
            '90'.' '.translate('يوم'),
            \Carbon\Carbon::parse($expired)->format('d-m-Y'),
             $residual,
            $diff

        ];
    }
}
