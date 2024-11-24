<?php

namespace App\Exports;

use App\Models\Contract;
use App\Models\Cv;
use App\Models\Office;
use App\Models\Reservation;
use App\Models\Staff;
use App\Models\User;
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


class CvExport implements FromCollection, WithMapping, WithHeadings,WithDrawings,ShouldAutoSize,WithStyles,WithColumnWidths
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
    protected $cv_type,$passport_key,$booking_status, $date,$nationality_id,$occuption_id, $exper_id,$region_id,$cv_status;


    function __construct($request) {
         $this->passport_key = ($request->passport_key)?$request->passport_key:null;
         $this->booking_status = ($request->booking_status)?$request->booking_status:null;
         $this->nationality_id = ($request->nationality_id)?$request->nationality_id:null;
         $this->cv_type = ($request->cv_type)?$request->cv_type:null;
         $this->occuption_id = ($request->occuption_id)?$request->occuption_id:null;
         $this->exper_id = ($request->exper_id)?$request->exper_id:null;
         $this->region_id = ($request->region_id)?$request->region_id:null;
         $this->cv_status=($request->cv_status)?$request->cv_status:null;
         $this->date = $request->date?$request->date:"";

    }
    public function collection()
    {
        $cvs = Cv::isRecruitment()->latest()->orderBy('is_out', 'ASC');
        if (Auth::user()->user_type != 'admin'){
            $all_ban_offices = \App\Models\Office::where('ban',1)->pluck('id')->toArray();
            $cvs = $cvs->whereNotIn('office', $all_ban_offices);
        }
        if ($this->occuption_id != null) {
            $cvs = $cvs->where('occuption_id', $this->occuption_id );
        }
        if ($this->passport_key != null) {
            $cvs = $cvs->where('passport_id', 'like', '%' . $this->passport_key . '%');
        }
        if ($this->exper_id != null) {
            $cvs = $cvs->where('exper_id', $this->exper_id);
        }

        if ($this->booking_status != null) {
            if ($this->booking_status == 1) {//sold
                $cvs = $cvs->where('is_sale', 1);
            } elseif ($this->booking_status == 6) {//booking with contract
                $cvs = $cvs->where('is_booking', 1)->withWhereHas('resvertions', function ($q)  {
                    $q->whereNotIn('status',[1,2,3,14])->whereNull('deleted_at')->whereHas('contract',function ($q)  {
                        $q->whereNull('deleted_at');
                    });
                });
            }
            elseif ($this->booking_status == 7) { //booking with reservtions
                $cvs = $cvs->where('is_booking', 1)->withWhereHas('resvertions', function ($q)  {
                    $q->doesntHave('contract')->whereNull('deleted_at')->whereIn('status',[1,2,3,14]);
                });
            }
            elseif ($this->booking_status == 2) {//booking
                $cvs = $cvs->where('is_booking', 1)->doesntHave('resvertions');
            }
            elseif ($this->booking_status == 3) {
                //not booking
                $cvs = $cvs->where('is_booking', 0);
            } elseif ($this->booking_status == 4) {
                //back out
                $cvs = $cvs->where('is_booking', 2);
            } elseif ($this->booking_status == 5) {
                $cvs = $cvs->where('is_booking', 3);
            }

        }
        if ($this->cv_type != null) {
            $cvs = $cvs->where('office', $this->cv_type);
        }
        if ($this->nationality_id != null) {
            $cvs = $cvs->where('national_id', $this->nationality_id);
        }
        if ($this->region_id != null) {
            $cvs = $cvs->where('region_id', $this->region_id);
        }
        if ($this->cv_status != null) {
            if ($this->cv_status == 1) {
                $cvs = $cvs->where('is_out', 1);
            }elseif($this->cv_status == 0){
                $cvs = $cvs->where('is_out', 0);

            }
        }
        if ($this->date != null) {
            $cvs = $cvs->whereDate('cvs.created_at', '>=', date('Y-m-d', strtotime(explode(" - ", $this->date)[0])))->whereDate('cvs.created_at', '<=', date('Y-m-d', strtotime(explode(" - ", $this->date)[1])));
        }
        return $cvs->get();
    }
    public function headings(): array
    {

        return ['رقم جواز السفر','الجنسية','اسم العاملة','اضافة بواسطة','التاريخ','المكتب','الحالة'];
    }
    public function map($res): array
    {
        if ($res->is_sale == 1 && $res->is_booking == 1)
          $status='مباع';
        elseif ($res->is_booking == 1) {

            $resv=  Reservation::where('cv_id',$res->id)->whereNull('deleted_at')->latest()->first();
            if(!empty($resv)){
                if(in_array($resv->status,[1,2,3,14])) {
                    $status='محجوز-طلب استقدام';

                } elseif(!empty($resv->contract))  {
                    $status='محجوز-بعقد';


                }else{
                    $status="تم التعاقد مع العميل - ﻻ يوجد عقد";
                }
            }else{
                $status='محجوز-بدون عقد';

            }
        }
        elseif ($res->is_booking == 0)
            $status='غير محجوز';
        elseif ($res->is_booking == 2)
            $status='باك اوت';
        elseif ($res->is_booking == 3)
            $status='معلق';
      return [
          $res->passport_id,
          ($res->nationality != null) ? translate($res->nationality->name) : "--",
          $res->cvs_name,
          User::find($res->added_by)->name??"--",
          date('d-m-Y h:i a', strtotime($res->created_at)),
          $res->officeRelation->name??"--",
          $status
      ];
    }
}
