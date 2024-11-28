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

class StoresVerifyDiscountsExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents, WithStyles
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
        return DB::table('store_discounts')
            ->select(
                'store_discounts.discountID as discountID',
                'users.employeeID as employeeID',
                'users.name as UserName',
                'users.lastName as UserLastName',
                'users.nationalCode as UserNationalCode',
                'users.mobileNumber as UserMobileNumber',
                'units.unitName as unitName',
                'employment_types.employmentTypeName as UserEmploymentTypeName',
                'stores.storeName as storeName',
                'store_discounts.discountDate as discountDate',
                'store_discounts.additionalNote as additionalNote',
                'store_discounts.trackingCode as trackingCode',
                'store_discounts.verification_two as verification_two',
            )
            ->join('users', 'store_discounts.userID', '=', 'users.userID')
            ->join('units', 'users.unitID', '=', 'units.unitID')
            ->join('employment_types', 'users.employmentTypeID', '=', 'employment_types.employmentTypeID')
            ->join('stores', 'store_discounts.storeID', '=', 'stores.storeID')
            ->where('store_discounts.verification_one', '=', 'verified')
            ->orderBy('discountID')
            ->when($this->ids, function ($query) {
                $query->whereIn('discountID', $this->ids);
            });
    }

    public function headings(): array
    {
        return [
            '#',
            'کد پرسنلی',
            'نام',
            'نام خانوادگی',
            'کد ملی',
            'موبایل',
            'واحد',
            'نوع استخدام',
            'نام فروشگاه',
            'برای تاریخ',
            'ملاحظات',
            'کد رهگیری',
            'وضعیت',
        ];
    }

    public function map($row): array
    {
        return [
            $row->discountID,
            $row->employeeID,
            $row->UserName,
            $row->UserLastName,
            $row->UserNationalCode,
            $row->UserMobileNumber,
            $row->unitName,
            $row->UserEmploymentTypeName,
            $row->storeName,
            verta($row->discountDate)->format('F Y'),
            $row->additionalNote,
            $row->trackingCode,
            $this->verficationStatus($row->verification_two),
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

    public function verficationStatus(string $status): string
    {
        if($status === 'waiting'){
            return 'در انتظار تایید';
        }else if($status === 'verified'){
            return 'تایید شده';
        }else{
            return 'رد شده';
        }
    }

}
