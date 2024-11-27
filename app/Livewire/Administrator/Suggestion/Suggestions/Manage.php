<?php

namespace App\Livewire\Administrator\Suggestion\Suggestions;

use App\Livewire\Administrator\BaseTableClass;
use App\Models\Club\ClubReservations;
use App\Models\Store\StoreDiscount;
use App\Models\Suggestion\Suggestion;
use App\Models\Suggestion\SuggestionsCommittee;
use App\Models\User\User;
use App\Policies\Store\StoreDiscountPolicy;
use App\Policies\Suggestion\SuggestionPolicy;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Lazy;
use Livewire\Attributes\Renderless;
use Livewire\WithPagination;

#[Lazy]
class Manage extends BaseTableClass
{
    use withPagination;

    public string $column = 'id';
    public string $selectedColumn = 'id';
    public string $primaryKey = 'id';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [];



    public function render(): View
    {
//        $categories = Category::pluck('id', 'name')->toArray();
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $suggestions = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($suggestions->total());

        $this->currentPageIds = $suggestions->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('suggestions', 'categories'));
    }


    public function delete(?int $id = null): void
    {
        $suggestion = new Suggestion();
        if (! Gate::check(SuggestionPolicy::ManageDelete, $suggestion)) {
            $this->showOpUnauthorized();
            return;
        }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $suggestion);

    }


    public function export()
    {
//        return (new UsersExport())->whereIn($this->ids)->download('data.xlsx');
    }

    #[Computed]
    protected function searchQuery(): QueryBuilder|EloquentBuilder
    {
        $committeeID = (SuggestionsCommittee::query()->where('userID', auth()->user()->userID)?->first())?->id;



        return Suggestion::query()
            ->when(! auth()->user()->hasRole(config('auth.super_admin')), function($query) use ($committeeID) {
                $query->where('suggestionCommitteeID', $committeeID);
            })
            ->select(
                'suggestions.id as id',
                'users.employeeID as employeeID',
                'users.name as name',
                'users.lastName as lastName',
                'suggestions.title as title',
                'suggestions.file as file',
                'suggestions.status as status',
                'suggestions.managerAnswer as managerAnswer',
                'suggestions.employeeAnswer as employeeAnswer',
                'suggestions.score as score',
                'suggestions.created_at as created_at',
                'suggestions.updated_at as updated_at',
                'suggestions.uniqueID as uniqueID',
                'suggestions.implementation_cost as implementation_cost',
                'suggestions.collaborator as collaborator',
                'suggestions.collaboratorEmployeeID as collaboratorEmployeeID',
                'suggestions.participation_percentage as participation_percentage',
                'suggestions.managerAnswer as managerAnswer',
                'suggestions.employeeAnswer as employeeAnswer',
                'suggestions_fields.name as suggestions_fields_name',
                'suggestions_impact_types.name as suggestions_impact_types_name',
                'suggestions_committees.name as suggestions_committees_name',
                'units.unitName as unitName')
            ->join('users', 'suggestions.userID', '=', 'users.userID')
            ->join('units', 'users.unitID', '=', 'units.unitID')
            ->join('suggestions_fields', 'suggestions.suggestionFieldID', '=', 'suggestions_fields.id')
            ->join('suggestions_impact_types', 'suggestions.suggestionImpactTypeID', '=', 'suggestions_impact_types.id')
            ->join('suggestions_committees', 'suggestions.suggestionCommitteeID', '=', 'suggestions_committees.id')
//            ->when(isset($this->categoryId), function ($query) {
//                $query->where('categories.id', $this->categoryId);
//            })
            ->when($this->search, function ($query) {
                $query->whereAny([
                    'employeeID',
                    'name',
                    'lastName',
                    'suggestions.title',
                    'suggestions_fields_name',
                    'suggestions_impact_types_name',
                    'suggestions_committees_name',
                    'unitName',
                ], 'like', '%' . $this->search . '%');
            });

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'employeeID' => 'employeeID',
            'name' => 'name',
            'lastName' => 'lastName',
            'title' => 'title',
            'status' => 'status',
            'managerAnswer' => 'managerAnswer',
            'employeeAnswer' => 'employeeAnswer',
            'score' => 'score',
            'created_at' => 'created_at',
            'updated_at' => 'updated_at',
            'suggestions_fields_name' => 'suggestions_fields_name',
            'suggestions_impact_types_name' => 'suggestions_impact_types_name',
            'suggestions_committees_name' => 'suggestions_committees_name',
            'unitName' => 'unitName',
            'savings' => 'savings',
            'implementation_cost' => 'implementation_cost',
            'collaborator' => 'collaborator',
            'collaboratorEmployeeID' => 'collaboratorEmployeeID',
            'participation_percentage' => 'participation_percentage',
            default => 'id',
        };
    }


    public function toggle(string $column, int $id): void {}
}
