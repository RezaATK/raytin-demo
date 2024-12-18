<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents, WithStyles
{
    use Exportable;

    public ?array $ids = null;

    public function whereIn($ids)
    {
        if ($ids) {
            $this->ids = $ids;
        }

        return $this;
    }

    public function query()
    {
        return DB::table('users')
            ->select(
                'userID',
                'employeeID',
                'name',
                'lastName',
                'gender',
                'nationalCode',
                'mobileNumber',
                'units.unitName as unitName',
                'employment_types.employmentTypeName as employment_types_name',
            )
            ->join('employment_types', 'users.employmentTypeID', '=', 'employment_types.employmentTypeID')
            ->join('units', 'users.unitID', '=', 'units.unitID')
            ->orderBy('userID')
            ->when($this->ids, function ($query) {
                $query->whereIn('userID', $this->ids);
            });
    }

    public function headings(): array
    {
        return [
            '#',
            'کد پرسنلی',
            'نام',
            'نام خانوادگی',
            'جنسیت',
            'کد ملی',
            'موبایل',
            'واحد',
            'نوع استخدام',
        ];
    }

    public function map($row): array
    {
        return [
            $row->userID,
            $row->employeeID,
            $row->name,
            $row->lastName,
            $row->gender === 'male' ? 'مذکر' : 'مونث',
            $row->nationalCode,
            $row->mobileNumber,
            $row->unitName,
            $row->employment_types_name,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setAutoFilter("A1:{$sheet->getHighestColumn(1)}1");
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()
                    ->getStyle('A1:' . $event->sheet->getDelegate()->getHighestColumn() . '1')
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setARGB('00bbff');
                $event->sheet->getDelegate()
                    ->getStyle('A1:' . $event->sheet->getDelegate()->getHighestColumn() . '1')
                    ->getFont()
                    ->setName('Arial')
                    ->setBold(true);
                $event->sheet->getDelegate()->setRightToLeft(true);
                $event->sheet->getDelegate()->getStyle('A:B')->getAlignment()->setHorizontal('right');
            },
        ];
    }

}
