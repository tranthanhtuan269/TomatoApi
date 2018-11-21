<?php

namespace App\Exports;

use App\DailyReport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class DailyExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    public function headings(): array
    {
        return [
            '#',
            'Date',
            'Address',
        ];
    }

    public function query()
    {
        $data = Order::query()->join('users', 'users.id', '=', 'orders.user_id')
        			->select(
        				'users.name', 
        				'users.phone', 
        				'orders.start_time',
        				'orders.price',
        				'orders.rewards',
        				'orders.promotional',
        				'orders.created_at',
        				'orders.updated_at'
        				)
        			->where('orders.created_at', '>', $this->date . ' 00:00:00')
        			->where('orders.created_at', '<=', $this->date . ' 23:59:59')
        			->where('orders.state', '=', 2);
        dd($data->get());
        return $data;
    }
    
    /**
    * @var Invoice $invoice
    */
    public function map($invoice): array
    {
        return [
            $invoice->invoice_number,
            Date::dateTimeToExcel($invoice->created_at),
        ];
    }
}
