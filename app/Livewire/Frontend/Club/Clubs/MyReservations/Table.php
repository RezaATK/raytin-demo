<?php

namespace App\Livewire\Frontend\Club\Clubs\MyReservations;

use App\Livewire\Frontend\TableSimpleBaseClass;
use App\Models\Club\ClubReservations;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\WithPagination;

#[Lazy]
class Table extends TableSimpleBaseClass
{
    use withPagination;

    public string $column = 'reservID';
    public string $selectedColumn = 'id';
    protected string $primaryKey = 'reservID';

    public array $currentPageIds = [];



    public function render(): View
    {
        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $myreservations = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($myreservations->total());

        $this->currentPageIds = $myreservations->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('myreservations'));
    }


    protected function export()
    {
//        return (new ClubCategorysExport())->whereIn($this->ids)->download('data.xlsx');
    }

    #[Computed]
    protected function searchQuery()
    {
        return ClubReservations::query()
            ->where('userID', auth()->user()->userID)
            ->selectRaw("club_reservation.reservID as id,
                            club_reservation.clubName as clubName,
                            concat(club_reservation.secondayUserName, ' ', club_reservation.secondayUserLastName) as fullName,
                            club_reservation.secondayUserNationalCode as nationalCode,
                            club_reservation.secondayUserRelationship as relation,
                            club_reservation.reservDate as date,
                            club_reservation.verification as verification,
                            club_reservation.trackingCode as trackingCode")
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'club_reservation.clubName',
                    'club_reservation.secondayUserName',
                    'club_reservation.secondayUserLastName',
                    'club_reservation.secondayUserNationalCode',
                    'club_reservation.secondayUserRelationship',
                ], 'like', '%' . $this->search . '%');
            });
    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'clubName' => 'club_reservation.clubName',
            'fullName' => 'club_reservation.secondayUserLastName',
            'lastName' => 'club_reservation.secondayUserLastName',
            'nationalCode' => 'club_reservation.secondayUserNationalCode',
            'relation' => 'club_reservation.secondayUserRelationship',
            'date' => 'club_reservation.reservDate',
            'verification' => 'club_reservation.verification',
            default => 'club_reservation.reservID',
        };
    }
}
