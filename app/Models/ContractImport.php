<?php

namespace App\Models;

use App\Models\User;
use App\Traits\ContractTrait;
use App\Traits\CvTrait;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ContractImport implements ToModel, WithHeadingRow
{
    use ContractTrait;
    public function model(array $row)
    {
        if ($row['campany'] == "روافد") {
            $cv = ($row['passport_number'] != null) ? Cv::where('passport_id', $row['passport_number'])->first() : null;
            $contract = Contract::where('out_ids', $row['id'])->where('contract_visa_num', $row['visa_id'])->first();
            $row['client_nationality'] = $this->verifyNationality($row['client_nationality']);
            if ($row['id'] != null) {
                if (empty($contract)) {
                    if ($cv != null) {
                        $cv_id = $cv->id;
                        $cv->salary = $row['monthly_salary'];
                        $cv->office = $this->verifyOffice($row['office']);
                        $cv->cvs_name=$row['cv_name'];
                        $cv->is_rapid=1;
                        $cv->cv_rev_type=1;
                        $cv->national_id= $this->verifyWorkerNationality($row['country_id']);
                        $cv->occuption_id= $this->verifyWorkerOccupation($row['occupation']);
                        $cv->region_id= $this->verifyWorkerReligion($row['religion_id']);
                        $cv->update();
                    } else if ($row['passport_number'] != '-') {
                        $cv = $this->createCv($row['cv_name'], $row['passport_number'], $row['occupation'], $row['country_id'], $row['religion_id'], $row['office'], $row['contract_date']);
                        $cv_id = $cv->id;
                    }
                 
                    return new Contract([
                        'resv_id' => $this->CreateReservtion($cv, $this->createUser($row['client_name'], $row['user_id'], $row['client_phone'], $row['client_nationality'], $row['client_address']), $row['admin'], $row['status'], $row['status_date'], $row['number_of_days'], $row['passport_number'], $row['contract_date']),
                        'date_contract' =>  $row['contract_date'],
                         'created_at' =>(strtotime(str_replace('/', '-', $row['contract_date']))==false) ?date('Y-m-d h:i:s', strtotime( $row['contract_date'])):date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $row['contract_date']))),
                        'contract_visa_num' => $row['visa_id'],
                        'is_out' => 1,
                        'out_ids' => $row['id'],
                                    'throwback_date' =>Carbon::createFromFormat('d/m/Y', $row['status_date'])->format('Y-m-d')  ,

                        'contract_total' => isset($row['contract_total']) ? $row['contract_total'] : "",
                        'contract_count_day' => $row['number_of_days'],
                        'contract_from_day' => date('m/d/Y',  strtotime($row['acheivement_from'])),
                        'contract_to_day' => date('m/d/Y',  strtotime($row['acheivement_to'])),
                        'contract_holiday_day' => $row['days_off'],
                        'contract_visa_Hijri_date' => $row['contract_visa_hijri_date'],
                        'contract_visa_date' => date('m/d/Y', strtotime( $row['contract_visa_date'])),
                        'contract_cost' => $row['contract_value'],
                        'musand_num' => $row['musand_number'],
                        'authorization_num' => $row['authorization_number'],

                    ]);
                } else {
                    if ($cv != null) {
                        $cv_id = $cv->id;
                        $cv->salary = $row['monthly_salary'];
                        $cv->office = $this->verifyOffice($row['office']);
                        $cv->cvs_name=$row['cv_name'];
                        $cv->is_rapid=1;
                        $cv->cv_rev_type=1;
                        $cv->national_id= $this->verifyWorkerNationality($row['country_id']);
                        $cv->occuption_id= $this->verifyWorkerOccupation($row['occupation']);
                        $cv->region_id= $this->verifyWorkerReligion($row['religion_id']);
                        $cv->update();
                    }
                    $contract->update([
                        'resv_id' => $this->CreateReservtion($cv, $this->createUser($row['client_name'], $row['user_id'], $row['client_phone'], $row['client_nationality'], $row['client_address']), $row['admin'], $row['status'], $row['status_date'], $row['number_of_days'], $row['passport_number'], $row['contract_date']),
                        'date_contract' => $row['contract_date'],
                        'created_at' =>(strtotime(str_replace('/', '-', $row['contract_date']))==false) ?date('Y-m-d h:i:s', strtotime( $row['contract_date'])):date('Y-m-d h:i:s', strtotime(str_replace('/', '-', $row['contract_date']))),
                        'contract_visa_num' => $row['visa_id'],
                        'is_out' => 1,
                        'out_ids' => $row['id'],
                        'throwback_date' =>Carbon::createFromFormat('d/m/Y', $row['status_date'])->format('Y-m-d')  ,

                        'contract_total' => isset($row['contract_total']) ? $row['contract_total'] : "",
                        'contract_count_day' => $row['number_of_days'],
                        'contract_from_day' => date('m/d/Y',  strtotime($row['acheivement_from'])),
                        'contract_to_day' => date('m/d/Y',  strtotime($row['acheivement_to'])),
                        'contract_holiday_day' => $row['days_off'],
                        'contract_visa_Hijri_date' => $row['contract_visa_hijri_date'],
                        'contract_visa_date' => date('m/d/Y', strtotime( $row['contract_visa_date'])),
                        'contract_cost' => $row['contract_value'],
                        'musand_num' => $row['musand_number'],
                        'authorization_num' => $row['authorization_number'],

                    ]);
                }
            }

        }
    }
}