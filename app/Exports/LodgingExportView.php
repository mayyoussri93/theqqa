<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use auth;



class LodgingExportView implements FromView
{


    protected $bookings;
    function __construct($bookings,$CvPreviousSponsor,$WorkerDeported,$reservationSponsorWithTrash,$reservationSponsor,$reservationSponsorProbation) {
        $this->bookings = $bookings??"";
        $this->CvPreviousSponsor=$CvPreviousSponsor??"";
        $this->WorkerDeported=$WorkerDeported??"";
        $this->reservationSponsorWithTrash=$reservationSponsorWithTrash??"";
        $this->reservationSponsor=$reservationSponsor??"";
        $this->reservationSponsorProbation=$reservationSponsorProbation??"";
    }

    public function view(): View
    {
        return view('backend.ReportManagement.Lodging.table', [
            'bookings' => $this->bookings,
            'CvPreviousSponsor'=>$this->CvPreviousSponsor,
            'WorkerDeported'=>$this->WorkerDeported,
            'reservationSponsorWithTrash'=>$this->reservationSponsorWithTrash,
            'reservationSponsor'=>$this->reservationSponsor,
            'reservationSponsorProbation'=>$this->reservationSponsorProbation,
        ]);
    }
}