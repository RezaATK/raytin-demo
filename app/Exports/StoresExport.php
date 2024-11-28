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

class StoresExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents, WithStyles
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
        return DB::table('stores')
            ->select(
                'stores.storeID as storeID',
                'stores.storeName as storeName',
                'stores.storeTerms as storeTerms',
                'stores.storeDetails as storeDetails',
                'stores.storeAddress as storeAddress',
                'stores.storeNeighborhood as storeNeighborhood',
                'storecategory.CategoryName as CategoryName',
                'stores.isActive as isActive',
            )
            ->join('storecategory', 'stores.storeCategoryID', '=', 'storecategory.storeCategoryID')
            ->orderBy('storeID')
            ->when($this->ids, function ($query) {
                $query->whereIn('storeID', $this->ids);
            });
    }

    public function headings(): array
    {
        return [
            '#',
            'نام فروشگاه',
            'شرایط',
            'توضیحات',
            'آدرس',
            'محله',
            'دسته بندی',
            'وضعیت',
        ];
    }

    public function map($row): array
    {
        return [
            $row->storeID,
            $row->storeName,
            $row->storeTerms,
            $row->storeDetails,
            $row->storeAddress,
            $row->storeNeighborhood,
            $row->storeCategoryName,
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
