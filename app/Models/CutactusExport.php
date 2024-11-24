<?php

namespace App\Models;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CutactusExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return ContactUs::get();
    }

    public function headings(): array
    {
        return [
            'name',
            'email',
            'subject',
            'massage',

        ];
    }

    /**
     * @var Product $product
     */
    public function map($product): array
    {

        return [
            $product->name,
            $product->email,
            $product->subject,
            $product->massage,

        ];
    }
}
