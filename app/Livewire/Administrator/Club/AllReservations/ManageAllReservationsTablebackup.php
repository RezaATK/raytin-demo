<?php

namespace App\Livewire\Administrator\Club\AllReservations;

use App\Livewire\Administrator\BaseTableClass;
use App\Models\Club\ClubReservations;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\WithPagination;

#[Lazy]
class ManageAllReservationsTablebackup extends BaseTableClass
{
    use withPagination;

    public string $column = 'reservID';
    public string $selectedColumn = 'reservID';
    public string $primaryKey = 'reservID';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [
        'status' => 'isActive',
    ];

//    public ClubReservations $clubReservations;

    protected $listeners = [
////        'reservation.{clubReservations.reservID}.updated' => '$refresh',
////        'reservation.10087.updated' => '$refresh',
        'approved' => '$refresh'
    ];



    public function render(): View
    {
//        $categories = Category::pluck('id', 'name')->toArray();
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $reserves = $query->paginate($this->pageSize);
        $this->setTotalItemsInSession($reserves->total());
        $this->currentPageIds = $reserves->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();
        return view('livewire.' . $this->__name, compact('reserves', 'categories'));
    }


    public function delete(?int $id = null): void
    {
        $reserve = new ClubReservations();
//        if (! Gate::check('delete', $reserve)) {
//            $this->showOpUnauthorized();
//            return;
//        }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $reserve);

    }



    #[Renderless]
    public function toggle(string $column, int $id): void
    {
//        $reserve = new ClubReservations();

//        if (! Gate::check('update', $reserve)) {
//            $this->showOpUnauthorized();
//            return;
//        }

//        $this->handleToggle($column, $id, $reserve);
    }





//<livewire:admin.table-row :clubReservations="$clubReservations" :key="$clubReservations->reservID" />



    public function export()
    {
//        return (new UsersExport())->whereIn($this->ids)->download('data.xlsx');
    }

    #[Computed]
    protected function searchQuery(): QueryBuilder|EloquentBuilder
    {
//        return ClubReservations::query()
//            ->select(
//                'club_reservation.reservID as reservID',
//                'club_reservation.clubID as clubID',
//                'club_reservation.userID as userID',
//                'users.employeeID as employeeID',
//                'users.name as name',
//                'users.lastName as lastName',
//                'users.nationalCode as nationalCode',
//                'clubs.clubName as clubName',
//                'clubs.genderSpecific as genderSpecific',
//                'club_reservation.reservDate as reservDate',
//                'club_reservation.secondayUserRelationship as secondayUserRelationship',
//                'club_reservation.secondayUserName as secondaryUserName',
//                'club_reservation.secondayUserLastName as secondayUserLastName',
//                'club_reservation.secondayUserNationalCode as secondaryUserNationalCode',
//                'club_reservation.trackingCode as trackingCode',
//                'club_reservation.verification as verification',
//                'employment_types.employmentTypeName as employmentTypeName',
//                'units.unitName as unitName')
//
//            ->join('users', 'club_reservation.userID', '=', 'users.userID')
//            ->join('units', 'users.unitID', '=', 'units.unitID')
//            ->join('employment_types', 'users.employmentTypeID', '=', 'employment_types.employmentTypeID')
//            ->join('clubs', 'club_reservation.clubID', '=', 'clubs.clubID')
////            ->when(isset($this->categoryId), function ($query) {
////                $query->where('categories.id', $this->categoryId);
////            })
//            ->when($this->search, function ($query) {
//                $query->whereAny([
//                    'name',
//                    'lastName',
//                    'nationalCode',
//                    'employeeID',
//                    'clubName',
//                    'secondayUserName',
//                    'secondayUserLastName',
//                    'trackingCode',
//                ], 'like', '%' . $this->search . '%');
//            });

        return ClubReservations::query()
            ->with('user', function(Builder $query){
                $query->select(['userID', 'unitID', 'employeeID', 'employmentTypeID', 'name', 'lastName', 'nationalCode'])
                      ->with('unit', function($query){
                          $query->select(['unitID', 'unitName']);
                      })
                      ->with('employmentType', function($query){
                          $query->select(['employmentTypeID', 'employmentTypeName']);
                      });
//                      ->when($this->search, function ($query) {
//                          $query->whereAny(['name', 'lastName', 'employeeID'], 'like', '%' . $this->search . '%');
//                      });
            })
            ->with('club', function(Builder $query){
                $query->select(['clubID', 'clubName', 'genderSpecific']);
            })
            ->select('reservID',
                'userID',
                'clubID',
                'primaryUserNationalCode',
                'reservDate',
                'secondayUserRelationship',
                'PrimaryUserName',
                'PrimaryUserLastName',
                'secondayUserName',
                'secondayUserLastName',
                'secondayUserNationalCode',
                'trackingCode',
                'verification',
            )
            ->when(isset($this->categoryId), function ($query) {
                $query->where('categories.id', $this->categoryId);
            })
            ->when($this->search, function (Builder $query) {
                $query->whereAny([
//                    'name',
//                    'lastName',
//                    'nationalCode',
//                    'users.employeeID',
                    'secondayUserName',
                    'secondayUserLastName',
                    'trackingCode',
                ], 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function(Builder $query) {
                      $query->whereAny([
                          'name',
                          'lastName',
                          'employeeID'
                      ], 'like', '%' . $this->search . '%');
                    });
//                ->orWhereHas('club', function(Builder $query) {
//                      $query->where('clubName', 'like', '%' . $this->search . '%');
//                    });
            });

//        return DB::table('club_reservation')
//            ->select(
//                'club_reservation.reservID as reservID',
//                'club_reservation.userID as userID',
//                'club_reservation.clubID as clubID',
//                'club_reservation.primaryUserNationalCode as primaryUserNationalCode',
//                'club_reservation.reservDate as reservDate',
//                'club_reservation.secondayUserRelationship as secondayUserRelationship',
//                'club_reservation.PrimaryUserName as PrimaryUserName',
//                'club_reservation.PrimaryUserLastName as PrimaryUserLastName',
//                'club_reservation.secondayUserName as secondayUserName',
//                'club_reservation.secondayUserLastName as secondayUserLastName',
//                'club_reservation.secondayUserNationalCode as secondayUserNationalCode',
//                'club_reservation.verification as verification',
//                'club_reservation.trackingCode as trackingCode',
//                'users.name as name',
//                'users.lastName as lastName',
//                'users.employeeID as employeeID',
//                'users.nationalCode as nationalCode',
//                'employment_types.employmentTypeName as employmentTypeName',
//                'units.unitName as unitName',
//                'clubs.clubName as clubName',
//                'clubs.genderSpecific as genderSpecific')
//            ->join('users', 'users.userID', '=', 'club_reservation.userID')
//            ->join('units', 'users.unitID', '=', 'units.unitID')
//            ->join('employment_types', 'employment_types.employmentTypeID', '=', 'users.employmentTypeID')
//            ->join('clubs', 'clubs.clubID', '=', 'club_reservation.clubID');

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'employeeID' => 'employeeID',
            'PrimaryUserFullName' => 'PrimaryUserFullName',
            'primaryUserNationalCode' => 'primaryUserNationalCode',
            'clubName' => 'clubName',
            'genderSpecific' => 'genderSpecific',
            'reservDate' => 'reservDate',
            'secondayUserRelationship' => 'secondayUserRelationship',
            'secondayUserFullName' => 'secondayUserFullName',
            'secondayUserNationalCode' => 'secondayUserNationalCode',
            'trackingCode' => 'trackingCode',
            'verification' => 'verification',
            'employmentTypeName' => 'employmentTypeName',
            'unitName' => 'unitName',
            default => 'reservID',
        };
    }

}
