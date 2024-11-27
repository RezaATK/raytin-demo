<?php

namespace App\Livewire\Administrator\Role;

use App\Livewire\Administrator\BaseTableClass;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;


class Manage extends BaseTableClass
{
    use withPagination;

    public string $column = 'id';
    public string $selectedColumn = 'id';
    public string $primaryKey = 'id';

    public string|int $categoryId;
    public array $currentPageIds = [];
    protected array $toggleable = [];



    public function render(): \Illuminate\Contracts\View\View
    {
        $categories = collect();

        $query = $this->searchQuery();
        $query = $this->sortTerms($query);
        $roles = $query->paginate($this->pageSize);

        $this->setTotalItemsInSession($roles->total());

        $this->currentPageIds = $roles->map(fn($item) => (string) $item->{$this->primaryKey})->toArray();

        return view('livewire.' . $this->__name, compact('roles', 'categories'));
    }


    public function delete(?int $id = null): void
    {
        $role = new Role();
        if ($role->name !== config('auth.super_admin')){

        }

//        if (! Gate::check('delete', $role)) {
//            $this->showOpUnauthorized();
//            return;
//        }

        $ids = $this->resolveIds($id);

        $this->handleDelete($ids, $role);

    }



    #[Renderless]
    public function toggle(string $column, int $id): void
    {
//        $role = new Role();

//        if (! Gate::check('update', $role)) {
//            $this->showOpUnauthorized();
//            return;
//        }

//        $this->handleToggle($column, $id, $role);
    }


    public function export()
    {
//        return (new RolesExport())->whereIn($this->ids)->download('data.xlsx');
    }

    #[Computed]
    protected function searchQuery()
    {
        return Role::query()->with('permissions')
            ->select('id','name')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
    }


    protected function getColumnForSort($column): string
    {
        return match ($column) {
            'name' => 'name',
            default => 'id',
        };
    }


}
