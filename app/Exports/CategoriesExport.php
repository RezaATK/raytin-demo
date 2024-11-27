<?php

namespace App\Exports;

use App\Models\Category;

use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;


class CategoriesExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents
{
    use Exportable;

    public ?array $ids = null;

    public function whereIn($ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function query()
    {
        return Category::query()->select(['id', 'name', 'status'])->when($this->ids, function ($query) {
            $query->whereIn('id', $this->ids);
        });
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
            'وضعیت',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->status === 1 ? 'فعال' : 'غیرفعال',
        ];
    }

}