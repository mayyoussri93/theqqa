<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;

class CentralArray implements ToModel, WithHeadingRow
{

    public function model(array $row)
    {




    }

}
