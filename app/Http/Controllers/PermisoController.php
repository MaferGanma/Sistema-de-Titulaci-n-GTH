<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    public function index()
    {
        $permisos = Permission::all();
        return view('sistema.user.permisos', compact('permisos'));
    }

    public function store(Request $request)
    {
        $permission = Permission::create(['name' => $request->input('nombre')]);
        return back();
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
