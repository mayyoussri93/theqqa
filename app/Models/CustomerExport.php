<?php

namespace App\Models;


use App\Models\Reservation;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CustomerExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        $customers = Customer::orderBy('created_at', 'desc');

        if (request()->search){
            $sort_search = request()->search;
            $user_ids = User::where('user_type', 'customer')->where(function($user) use ($sort_search){
                $user->where('name', 'like', '%'.$sort_search.'%')->orWhere('email', 'like', '%'.$sort_search.'%');
            })->pluck('id')->toArray();
            $customers = $customers->where(function($customer) use ($user_ids){
                $customer->whereIn('user_id', $user_ids);
            });
        }
        if (request()->status) {
            $user_ids2 = Reservation::whereHas('user')->pluck('user_id')->toArray();
            if (request()->status == 1) {
                $customers = $customers->where(function ($customer) use ($user_ids2) {
                    $customer->whereIn('user_id', $user_ids2);
                });
            }else{
                $customers = $customers->where(function ($customer) use ($user_ids2) {
                    $customer->whereNotIn('user_id', $user_ids2);
                });
            }
        }
        if (request()->date_range) {
            $date_range1 = explode(" / ", request()->date_range);
            $start =date('Y-m-d', strtotime($date_range1[0]) );
            $end =date('Y-m-d', strtotime($date_range1[1]) );
            $customers = $customers->whereDate('created_at', '>=', $start)->whereDate('created_at', '<=', $end );
        }
        $all_customer=$customers->pluck('user_id')->toArray();
        return User::whereIn('id',$all_customer)->get();
    }

    public function headings(): array
    {
        return [
            'name',
            'phone',
        ];
    }

    /**
     * @var User $customer
     */
    public function map($customer): array
    {

        return [
            $customer->name,
            $customer->phone,
        ];
    }
}
