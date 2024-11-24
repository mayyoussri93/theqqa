<?php

namespace App\Models;


use App\Models\ClientOut;
use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use auth;
class ClientOutExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
   if(Auth::user()->user_type == 'admin' ){
        
        return ClientOut::get();
        }else{
                   return ClientOut::where('user_id',Auth::user()->id)->get();
        }
    }

    public function headings(): array
    {
        return [
            'name',
            'phone',
            'city',
            'service'
        ];
    }

    /**
     * @var Product $product
     */
    public function map($product): array
    {

        return [
            $product->name,
            $product->phone,
            $product->city,
            $product->service,

        ];
    }
}
