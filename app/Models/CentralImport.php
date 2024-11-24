<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class CentralImport implements ToModel, WithHeadingRow
{
    public function  __construct($count)
    {
        $this->count= $count;
        $this->staff_count=Staff::whereHas('user')->count();
        $this->staff_list=Staff::whereHas('user')->pluck('user_id')->toArray();
    }
    private $rows = 0;
    private $shift_staff = 0;
    public function model(array $row)
    {
        $phones=Central::get()->pluck('phone')->toArray();
        ++$this->rows;
$date=explode(' ',$row['date']);
if($this->rows>(floor($this->count/$this->staff_count)-1)){


    $this->rows=0;
    ++$this->shift_staff;
}
if(!in_array($row['number'],$phones)) {
    return  new Central([
        'date' => Carbon::createFromFormat('m/d/Y', $date[0])->format('Y-m-d'),
        'phone' => $row['number'],
        'employee_by' => $this->staff_list[$this->shift_staff]??$this->staff_list[0],
        'status' => 'NO ANSWER',
        'time' => $date[1] . $date[2],

    ]);

}

    }
    public function getRowCount(): int
    {
        return $this->rows;
    }
}
