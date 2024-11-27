<?php

namespace App\Livewire\Frontend\Food\Foods\MyReservations;

use App\Livewire\Frontend\TableSimpleBaseClass;
use App\Models\Food\FoodReservation;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

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
        $currentMonth = jalaliToGregorian(verta()->startMonth()->formatDate());
        $nextMonth = jalaliToGregorian(verta()->addMonth()->startMonth()->formatDate());
        return FoodReservation::query()
            ->join('users', 'food_reservation.userID', '=', 'users.userID')
            ->join('foods', 'food_reservation.foodID', '=', 'foods.foodID')
            ->where('food_reservation.userID', auth()->user()->userID)
            ->whereBetween('food_reservation.reservDate', [$currentMonth, $nextMonth])
            ->selectRaw('food_reservation.reservID,
                                    food_reservation.foodID,
                                    foods.foodName as foodName,
                                    concat(users.name, " ", users.Lastname) as name,
                                    food_reservation.reservDate as reservDate')
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'foods.foodName',
                ], 'like', '%' . $this->search . '%');
            });
    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'name' => 'fullName',
            'foodName' => 'food_reservation.foodName',
            'date' => 'food_reservation.reservDate',
            default => 'food_reservation.reservID',
        };
    }
}
