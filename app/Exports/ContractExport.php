<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\ContractSource;
use App\Models\Cv;
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


class ContractExport implements FromCollection, WithMapping, WithHeadings,WithDrawings,ShouldAutoSize,WithStyles,WithColumnWidths
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
    protected $is_out,$cv_name,$cv_type,$passport_key,$booking_status,$date,$selected_staff,$nationality_id,$occuption_id,$client_name,$client_nationality_id,$client_phone,$visa_worker_num,$sorting,$contract_source;


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
        $this->sorting= $request->sorting?$request->sorting:null;
        $this->cv_name=$request->cv_name?$request->cv_name:null;
        $this->is_out=$request->is_out?$request->is_out:0;
        $this->contract_source=$request->contract_source?$request->contract_source:null;
    }
    public function collection()
    {

        $bookings = Reservation::whereNull('deleted_at')->withWhereHas('contract', function ($q) {
            if($this->is_out == 0 or $this->is_out == 1) {
                $q->where('is_out', $this->is_out);
            }
        })->with(['user.customer','contract','cv.officeRelation','Adminstaff','cv.nationality','cv.recruitmentFormOccupation','cv.airport']);

        if (Auth::user()->user_type == 'admin' || in_array('129', json_decode(Auth::user()->staff->role->permissions)) || Staff::where('user_id', auth::user()->id)->first()->role_id == 5) {
            if (Auth::user()->user_type != 'admin' && in_array('233', json_decode(Auth::user()->staff->role->permissions))){
                $bookings =$bookings;
            }else{
                $bookings =$bookings->latest();
            }

        } else {
            $bookings = $bookings->where('administrator_id', auth::user()->id);
            if (Auth::user()->user_type != 'admin' && in_array('233', json_decode(Auth::user()->staff->role->permissions))){
                $bookings =$bookings;
            }else{
                $bookings =$bookings->latest();
            }
        }
        if (  $this->client_name != null) {
            $bookings = $bookings->withWhereHas('user', function ($q)  {
                $q->name($this->client_name);
            });
        }
        if ($this->client_phone != null) {
            $bookings = $bookings->withWhereHas('user', function ($q)  {
                $q->phone($this->client_phone);
            });
        }
        if ($this->client_nationality_id != null) {
            $bookings = $bookings->withWhereHas('user', function ($q)  {
                $q->withWhereHas('customer',  function ($q2)  {
                    $q2->where('national_identification_number', $this->client_nationality_id );

                });
            });
        }
        if ($this->nationality_id != null) {
            $bookings = $bookings->withWhereHas('cv', function ($q)  {
                $q->where('national_id', $this->nationality_id);
            });
        }
        if ($this->occuption_id != null) {
            $bookings = $bookings->withWhereHas('cv', function ($q) {
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
            $bookings = $bookings->withWhereHas('contract', function ($q)  {
                $q->whereDate('created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $this->date)[0])))->whereDate('created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $this->date)[1])));
            });
        }
        if ($this->cv_type != null) {
            $cvs = Cv::where('office', $this->cv_type)->pluck('id')->toArray();
            $bookings = $bookings->whereIn('cv_id', $cvs);
        }
        if ($this->visa_worker_num != null) {
            $bookings = $bookings->withWhereHas('contract', function ($q)  {
                $q->where('contract_visa_num', $this->visa_worker_num );
            });
        }
        if ($this->contract_source != null) {
            $bookings = $bookings->withWhereHas('contract', function ($q)  {
                $q->where('contract_source_id', $this->contract_source );
            });
        }
        return $bookings->get();
    }
    public function headings(): array
    {
        return
            ['اسم العميل','رقم الهوية','رقم التأشيرة', 'رقم عقد مساند', 'رقم جواز السفر','اسم العامل/ة','الجنسية',
                'المهنة','تاريخ الانشاء','المكتب','حالة العقد','المسوق','مدة التقديم','مصدر العقد'];
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
//            $res->contract->id,
            $res->user->name,
            $res->user->customer->national_identification_number,
            $res->contract->contract_visa_num,
            $res->contract->musand_num,
            $res->cv->passport_id??"--",
            $res->cv->cvs_name??"--",
            $res->cv->nationality->name??"--",
            $res->cv->recruitmentFormOccupation->name??"--",
            date('d-m-Y', strtotime($res->contract->created_at)),
            $res->cv->officeRelation->name??"--",
            $current_status,
            $admin,
            $days,
            ($res->contract->contract_source_id != null) ? ContractSource::find($res->contract->contract_source_id)->name :"--"

        ];
    }
}