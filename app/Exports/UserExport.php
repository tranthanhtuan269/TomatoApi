<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UserExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize
{
    use Exportable;

    public function __construct()
    {
    }

    public function headings(): array
    {
        return [
            'ID', 
            'Name', 
            'Email', 
            'Phone', 
            'Address', 
            'Active',
            'Presenter',
            'Code',
            'Coin',
            'Created_at',
            'Updated_at'
        ];
    }

    public function query()
    {
        $data = User::query()->select(
                                                    'id', 
                                                    'name', 
                                                    'email', 
                                                    'phone', 
                                                    'address',
                                                    'active',
                                                    'presenter_id',
                                                    'code',
                                                    'coin', 
                                                    'created_at', 
                                                    'updated_at'
        				);
        return $data;
    }

    /**
    * @var Invoice $invoice
    */
    public function map($user): array
    {
        setlocale(LC_MONETARY, 'it_IT');
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->phone,
            $user->address,
            $user->active,
            $user->presenter_id,
            $user->code,
            number_format($user->coin,2,",","."),
            $user->created_at,
            $user->updated_at
        ];
    }
}
