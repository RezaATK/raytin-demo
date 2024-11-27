<?php

namespace App\Livewire\Administrator\Club\AllReservations;

use App\Livewire\Administrator\BaseTableClass;
use App\Models\Club\ClubReservations;
use App\Policies\Club\ClubReservationPolicy;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\WithPagination;

#[Lazy]
class Manage extends BaseTableClass
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


    public function render(): View
    {
//        $categories = Category::pluck('id', 'name')->toArray();
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $reserves = $query->paginate($this->pageSize);
//        dd($reserves);
        $this->setTotalItemsInSession($reserves->total());
        $this->currentPageIds = $reserves->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('reserves', 'categories'));
    }


    public function delete(?int $id = null): void
    {
        Gate::authorize(ClubReservationPolicy::DELETE, new ClubReservations());

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
            ->select(
                'club_reservation.reservID as reservID',
                'clubs.clubID as clubID',
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
            ->leftJoin('clubs', function($join){
                $join->on('clubs.clubID','=','club_reservation.clubID');
            })
            ->leftJoin('users',function($join){
                $join->on('users.userID','=','club_reservation.userID');
            })
            ->leftJoin('units',function($join){
                $join->on('users.unitID','=','units.unitID');
            })
            ->leftJoin('employment_types',function($join){
                $join->on('users.employmentTypeID','=','employment_types.employmentTypeID');
            })
//            ->when(isset($this->categoryId), function ($query) {
//                $query->where('categories.id', $this->categoryId);
//            })
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'name',
                    'lastName',
                    'nationalCode',
                    'employeeID',
                    'clubName',
                    'secondayUserName',
                    'secondayUserLastName',
                    'trackingCode',
                ], 'like', '%' . $this->search . '%');
            });
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
//            ->join('clubs', 'club_reservation.clubID', '=', 'clubs.clubID');
//            ->when(isset($this->categoryId), function ($query) {
//                $query->where('categories.id', $this->categoryId);
//            })
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

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'employeeID' => 'employeeID',
            'PrimaryUserFullName' => 'users.lastName',
            'clubName' => 'clubName',
            'primaryUserNationalCode' => 'nationalCode',
            'genderSpecific' => 'genderSpecific',
            'reservDate' => 'reservDate',
            'secondayUserRelationship' => 'secondayUserRelationship',
            'secondaryUserFullName' => 'secondayUserLastName',
            'secondayUserNationalCode' => 'secondayUserNationalCode',
            'trackingCode' => 'trackingCode',
            'verification' => 'verification',
            'employmentTypeName' => 'employmentTypeName',
            'unitName' => 'unitName',
            default => 'reservID',
        };
    }

}
