<?php

namespace App\Models;

use App\Models\User;
use App\Traits\CvTrait;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class CvImport implements ToModel, WithHeadingRow
{
    use CvTrait;
    public function model(array $row)
    {
if(  !empty($row['passport_id']) && !in_array($row['passport_id'],Cv::get()->pluck('passport_id')->toArray())) {
    return new Cv([
        'cvs_name' => $row['name'],
        'occuption_id' => $this->verifyOccupation($row['job']),
        'national_id' => $this->verifyNationality($row['nationality'], $row['job'], $row['exp']),
        'region_id' => $this->verifyReligion($row['religion']),
        'age_id' => $row['age'],
        'exper_id' => $this->verifyExperience($row['exp']),
        'office' => $this->verifyOffice($row['office']),
        'is_booking' => $this->verifyBooking($row['is_rev']),
        'passport_id' => $row['passport_id'],
        'is_out' => 1,

    ]);

}
    }
}
