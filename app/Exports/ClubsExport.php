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

class ClubsExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents, WithStyles
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
        return DB::table('clubs')
            ->select(
                'clubs.clubID as clubID',
                'clubs.clubName as clubName',
                'clubs.clubDetails as clubDetails',
                'clubs.clubAddress as clubAddress',
                'clubs.clubNeighborhood as clubNeighborhood',
                'clubs.genderSpecific as genderSpecific',
                'clubcategory.CategoryName as CategoryName',
                'clubs.isActive as isActive',
            )
            ->join('clubcategory', 'clubs.clubCategoryID', '=', 'clubcategory.clubCategoryID')
            ->orderBy('clubID')
            ->when($this->ids, function ($query) {
                $query->whereIn('clubID', $this->ids);
            });
    }

    public function headings(): array
    {
        return [
            '#',
            'نام باشگاه',
            'توضیحات',
            'آدرس',
            'محله',
            'ویژه',
            'دسته بندی',
            'وضعیت',
        ];
    }

    public function map($row): array
    {
        return [
            $row->clubID,
            $row->clubName,
            $row->clubDetails,
            $row->clubAddress,
            $row->clubNeighborhood,
            $row->genderSpecific,
            $row->CategoryName,
            $row->isActive === 1 ? 'فعال' : 'غیرفعال',
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