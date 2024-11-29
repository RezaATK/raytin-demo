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

class FoodsExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents, WithStyles
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
        return DB::table('foods')
        ->select(
            'foods.foodID as foodID',
            'foods.foodName as foodName',
            'foods.foodPrice as foodPrice',
            'foodcategory.categoryName as categoryName',
            'foods.isActive as isActive')
        ->join('foodcategory', 'foodcategory.foodCategoryID', '=', 'foods.foodCategoryID')
            ->orderBy('foodID')
            ->when($this->ids, function ($query) {
                $query->whereIn('foodID', $this->ids);
            });
    }

    public function headings(): array
    {
        return [
            '#',
            'نام غذا',
            'هزینه',
            'دسته بندی',
            'وضعیت',
        ];
    }

    public function map($row): array
    {
        return [
            $row->foodID,
            $row->foodName,
            $row->foodPrice,
            $row->categoryName,
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
