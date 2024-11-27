<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;


class RolesExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents
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
        return DB::table('sub_categories')
            ->select([
                'sub_categories.id as id', 'sub_categories.name as name', 'categories.name as categoryName',
                'sub_categories.status as status'
            ])
            ->join('categories', 'categories.id', '=', 'sub_categories.category_id')
            ->when($this->ids, function ($query) {
                $query->whereIn('sub_categories.id', $this->ids);
            })->orderBy('sub_categories.id', 'asc');
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
            'نام سرویس',
            'وضعیت',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $row->categoryName,
            $row->status === 1 ? 'فعال' : 'غیرفعال',
        ];
    }

}