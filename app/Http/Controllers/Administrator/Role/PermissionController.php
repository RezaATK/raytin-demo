<?php

namespace App\Http\Controllers\Administrator\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::query()->paginate(10);
        return view('role.permission.index', compact('permissions'));
    }


    public function create()
    {
        return view('role.permission.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'name_fa' => 'required|max:255',
            'group_name' => 'required|max:255',
            'section_name' => 'required|max:255',
        ]);
        $validated = $validated + ['guard_name' => 'web'];

        Permission::create($validated);

        return back()->with('success', 'success');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Permission $permission)
    {
        return view('role.permission.edit', compact('permission'));
    }


    public function update(Request $request, Permission $permission)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'name_fa' => 'required|max:255',
            'group_name' => 'required|max:255',
            'section_name' => 'required|max:255',
        ]);

        $permission->update($validated);

        return back()->with('success', 'success');
    }


    public function destroy(string $id)
    {
        //
    }
}
