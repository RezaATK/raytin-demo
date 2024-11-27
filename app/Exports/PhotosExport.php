<?php

namespace App\Exports;

use App\Models\News;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;


class PhotosExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents
{
    use Exportable;

    public ?array $ids = [];

    public function whereIn($ids)
    {
        $this->ids = $ids;

        return $this;
    }

    public function query()
    {
        return DB::table('photo')
            ->select('photo.id as id',
                'photo.title as title',
                'photo.status as status',
                'photo.is_featured as is_featured',
                'categories.name as categoryName',
                'sub_categories.name as subCategoryName')
            ->join('categories', 'photo.category_id', '=', 'categories.id')
            ->join('sub_categories', 'photo.sub_category_id', '=', 'sub_categories.id')
            ->when($this->ids, function ($query) {
                $query->whereIn('photo.id', $this->ids);
            })
            ->orderBy('photo.id', 'asc');
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
            'عنوان',
            'نام سرویس',
            'نام زیرسرویس',
            'وضعیت',
            'خبر ویژه',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->title,
            $row->categoryName,
            $row->subCategoryName,
            $row->status === 1 ? 'فعال' : 'غیرفعال',
            $row->is_featured === 1 ? 'بلی' : 'خیر',
        ];
    }

}