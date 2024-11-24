<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use auth;



class CvExportView implements FromView
{


    protected $bookings;
    function __construct($bookings,$contractInSponsor,$WorkerDeported,$ReservationSponsor,$reservationSponsorProbation) {
        $this->bookings = $bookings??"";
        $this->contractInSponsor=$contractInSponsor??"";
        $this->WorkerDeported=$WorkerDeported??"";
        $this->ReservationSponsor=$ReservationSponsor??"";
        $this->reservationSponsorProbation=$reservationSponsorProbation??"";
    }

    public function view(): View
    {
        return view('backend.ReportManagement.Cv.table', [
            'bookings' => $this->bookings,
            'contractInSponsor'=>$this->contractInSponsor,
            'WorkerDeported'=>$this->WorkerDeported,
            'ReservationSponsor'=>$this->ReservationSponsor,
            'reservationSponsorProbation'=>$this->reservationSponsorProbation,
        ]);
    }
}