<?php

namespace App\Http\Controllers\Administrator\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        return to_route('role.manage');
    }

    public function manage()
    {
        return view('role.index');
    }


    public function create()
    {
        $permissions = Permission::all();

        return view('role.create', compact('permissions'));
    }


    public function store(RoleRequest $request)
    {
        $role = Role::create($request->validated());

        $role->syncPermissions($request->get('permissions'));

        return to_route('role.create')->with('success', 'success');

    }

    public function show($id)
    {

    }


    public function edit(Role $role)
    {
        $permissions = Permission::all();

        $rolesPermissions = $role->load('permissions')->permissions->pluck('name')->toArray();

        return view('role.edit', compact('role', 'rolesPermissions', 'permissions'));
    }


    public function update(RoleRequest $request, Role $role)
    {
        $role->update($request->validated());

        $role->syncPermissions($request->get('permissions'));

        return to_route('role.edit', $role)->with('success', 'success');
    }


    public function destroy($id)
    {

    }
}
