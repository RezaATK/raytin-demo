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
use Spatie\Permission\Models\Role;

class RolesExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents, WithStyles
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
        return Role::query()->with('permissions')
        ->select('id','name')
            ->when($this->ids, function ($query) {
                $query->whereIn('roles.id', $this->ids);
            });
    }

    public function headings(): array
    {
        return [
            '#',
            'نام',
            'سطح دسترسی ها',
        ];
    }
    

    public function map($row): array
    {
        return [
            $row->id,
            $row->name,
            $this->getPermissions($row->permissions, $row->name),
            $row->status === 1 ? 'فعال' : 'غیرفعال',
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

    public function getPermissions($permissions, $name)
    {
        if($name === config('auth.super_admin')){
            return 'تمام دسترسی ها';
        }
        $permissionsList = '';
        $char = '، ';
        for($i=0; $i < count($permissions); $i++){
            if($i == (count($permissions) - 1) ){
                $char = '';
            }
            
            $permissionsList .= $permissions[$i]->name_fa . $char;
        }

        return $permissionsList;
    }

}