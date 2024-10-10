<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $permisos = Permission::all();
        $roles = Role::all();
        return view('sistema.user.roles', compact('roles','permisos'));
    }


    public function store(Request $request)
    {
        $role = Role::create(['name' => $request->input('nombre')]);//spatie
        return back();
    }

    public function update(Request $request, string $id)
    {
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');

        // Actualizar los permisos del rol
        $role->syncPermissions($request->input('permissions', []));

        $role->save();

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');
    }

    public function destroy(string $id)
    {
        //
    }
}
