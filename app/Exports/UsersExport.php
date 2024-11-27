<?php

namespace App\Exports;

use App\Models\User\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;


class UsersExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents
{
    use Exportable;

    public ?array $ids = null;

    public function whereIn($ids)
    {
        if($ids){
            $this->ids = $ids;
        }

        return $this;
    }

    public function query()
    {
        return User::query()
//            ->with('roles')
            ->select('userID',
                'name',
                'email',
                'mobileNumber')->whereIn('userID', $this->ids);
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }


    public function headings(): array
    {
        return [
            '#',
            'نام',
            'موبایل',
            'ایمیل',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->mobile,
            $row->email,
        ];
    }

}