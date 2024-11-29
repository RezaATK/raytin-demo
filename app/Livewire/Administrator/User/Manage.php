<?php

namespace App\Livewire\Administrator\User;

use App\Exports\UsersExport;
use App\Livewire\Administrator\BaseTableClass;
use App\Models\User\User;
use App\Policies\User\UserPolicy;
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

    public string $column = 'userID';
    public string $selectedColumn = 'userID';
    public string $primaryKey = 'userID';

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
        $users = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($users->total());

        $this->currentPageIds = $users->map(fn($user) => (string) $user->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('users', 'categories'));
    }


    public function delete(?int $id = null): void
    {
        $user = new User();
        if (! Gate::check(UserPolicy::DELETE, $user)) {
            $this->showOpUnauthorized();
            return;
        }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $user);

    }



    #[Renderless]
    public function toggle(string $column, int $id): void
    {
        $user = new User();
        // if (! Gate::check(UserPolicy::, $user)) {
            // $this->showOpUnauthorized();
            // return;
        // }

        $this->handleToggle($column, $id, $user);
    }


    public function export()
    {
        $user = new User();
        if (! Gate::check(UserPolicy::EXPORT, new User())) {
            $this->showOpUnauthorized();
            return;
        }

        return (new UsersExport())->whereIn($this->ids)->download("users-" . verta()->formatDate() . ".xlsx");
        // return (new UsersExport())->whereIn($this->ids)->queue("users-" . verta()->formatDate() . ".xlsx");
    }

    #[Computed]
    protected function searchQuery(): QueryBuilder|EloquentBuilder
    {
        return User::query()
            ->select(
                'users.userID as userID',
                'users.name as name',
                'users.lastName as lastName',
                'users.mobileNumber as mobileNumber',
                'users.gender as gender',
                'users.nationalCode as nationalCode',
                'users.unitID as unitID',
                'users.employmentTypeID as employmentTypeID',
                'users.isActive as isActive',
                'employment_types.employmentTypeName as employmentTypeName',
                'units.unitName as unitName')
            ->join('units', 'users.unitID', '=', 'units.unitID')
            ->join('employment_types', 'users.employmentTypeID', '=', 'employment_types.employmentTypeID')
//            ->when(isset($this->categoryId), function ($query) {
//                $query->where('categories.id', $this->categoryId);
//            })
            ->when($this->search, function ($query) {
                $query->whereAny(['users.name',
                                  'users.lastName',
                                  'users.mobileNumber',
                                  'users.nationalCode',
                                    ], 'like', '%' . $this->search . '%');
            });

    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'title' => 'name',
            'lastName' => 'lastName',
            'mobileNumber' => 'mobileNumber',
            'gender' => 'gender',
            'nationalCode' => 'nationalCode',
            'unitName' => 'unitName',
            'employmentTypeName' => 'employmentTypeName',
            'status' => 'isActive',
            default => 'userID',
        };
    }

}
