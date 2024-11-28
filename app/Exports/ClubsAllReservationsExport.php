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

class ClubsAllReservationsExport implements FromQuery, withHeadings, shouldAutoSize, withMapping, withEvents, WithStyles
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
        return DB::table('club_reservation')
        ->select(
            'club_reservation.reservID as reservID',
            'users.userID as userID',
            'users.employeeID as employeeID',
            'users.name as name',
            'users.lastName as lastName',
            'users.nationalCode as nationalCode',
            'clubs.clubName as clubName',
            'clubs.genderSpecific as genderSpecific',
            'club_reservation.reservDate as reservDate',
            'club_reservation.secondayUserRelationship as secondayUserRelationship',
            'club_reservation.secondayUserName as secondaryUserName',
            'club_reservation.secondayUserLastName as secondayUserLastName',
            'club_reservation.secondayUserNationalCode as secondayUserNationalCode',
            'club_reservation.trackingCode as trackingCode',
            'club_reservation.verification as verification',
            'employment_types.employmentTypeName as employmentTypeName',
            'units.unitName as unitName')
        ->join('clubs', 'club_reservation.clubID', '=', 'clubs.clubID')
        ->join('users', 'club_reservation.userID', '=', 'users.userID')
        ->join('units', 'users.unitID', '=', 'units.unitID')
        ->join('employment_types', 'users.employmentTypeID', '=', 'employment_types.employmentTypeID')
        ->orderBy('reservID')
        ->when($this->ids, function ($query) {
            $query->whereIn('reservID', $this->ids);
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
            'باشگاه',
            'ویژه',
            'رزرو برای',
            'نام',
            'نام خانوادگی',
            'کد ملی رزرو شده',
            'کد رهگیری',
            'نوع استخدام',
            'واحد',
            'برای تاریخ',
            'وضعیت',
        ];
    }

    public function map($row): array
    {
        return [
            $row->reservID,
            $row->employeeID,
            $row->name,
            $row->lastName,
            $row->nationalCode,
            $row->clubName,
            $row->genderSpecific,
            $row->secondayUserRelationship,
            $row->secondaryUserName,
            $row->secondayUserLastName,
            $row->secondayUserNationalCode,
            $row->trackingCode,
            $row->employmentTypeName,
            $row->unitName,
            verta($row->reservDate,)->format('F Y'),
            $this->verficationStatus($row->verification),
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
        if($status === 'pending'){
            return 'در انتظار تایید';
        }else if($status === 'verified'){
            return 'تایید شده';
        }else{
            return 'رد شده';
        }
    }

}
