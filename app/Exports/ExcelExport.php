<?php

namespace App\Exports;

use App\Order;
use App\DailyReport;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExcelExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function __construct(string $fromDate, string $toDate, $service_id)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->serviceId = $service_id;
    }

    public function headings(): array
    {
        return [
            'Service Name',
            'Start Time',
            'Price',
            'Real Price',
            'Rewards',
            'Presenter',
            'Promotional',
            'Promotional Code',
        ];
    }

    public function query()
    {
        $data = Order::query()->join('users', 'users.id', '=', 'orders.user_id')
                                            ->leftjoin('services', 'services.id', '=', 'orders.service_id')
        			     ->select(
                                                    'services.name as name',
                                                    'orders.start_time as start_time',
                                                    'orders.price as price',
                                                    'orders.real_price as real_price',
                                                    'orders.rewards as rewards',
                                                    'users.presenter_id as presenter_code',
                                                    'orders.promotional as promotional',
                                                    'orders.promotion_code as promotional_code'
        				)
        			->where('orders.start_time', '>', strtotime($this->fromDate . ' 00:00:00')*1000)
        			->where('orders.start_time', '<=', strtotime($this->toDate . ' 23:59:59')*1000)
        			->where('orders.state', '=', 2);

        if($this->serviceId != 0){
            $data->where('orders.service_id', '=', $this->serviceId);
        }
        return $data;
    }

    /**
    * @var Invoice $invoice
    */
    public function map($order): array
    {
        setlocale(LC_MONETARY, 'it_IT');
        return [
            $order->name,
            gmdate("H:i:s d-m-Y", $order->start_time/1000),
            number_format($order->price,2,",","."),
            number_format($order->real_price,2,",","."),
            number_format($order->rewards,2,",","."),
            $order->presenter_code == 1 ? '' : $order->presenter_code,
            number_format($order->promotional,2,",","."),
            $order->promotional_code
        ];
    }
    
    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
            'D' => NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE,
        ];
    }
}
