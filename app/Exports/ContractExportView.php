<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use auth;



class ContractExportView implements FromView
{


    protected $bookings;
    function __construct($bookings) {
        $this->bookings = $bookings??"";


    }

    public function view(): View
    {
        return view('backend.ReportManagement.Contract.table', [
            'bookings' => $this->bookings
        ]);
    }
}