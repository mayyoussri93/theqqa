<?php

namespace App\Jobs;

use App\Exports\ContractExport;
use App\Exports\TransactionsExport;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Excel;


class ExportJob implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data_request;
    protected $folder;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data_request,$folder)
    {
        $this->data_request = $data_request;
        $this->folder = $folder;

    }
    public function handle()
    {
//        (new ContractExport($this->data_request))->store('Export/->store('.$this->folder.'-contract.csv');
Excel::store(new ContractExport($this->data_request), 'Export/'.$this->folder.'-contract.csv');
//         Excel::store(new ContractExport($this->data_request),  'Export/'.$this->folder.'-contract.pdf', \Maatwebsite\Excel\Excel::MPDF);

//        (new TransactionsExport($this->data_request))->store('Export/'.$this->folder.'-contract.csv');
    }
}
