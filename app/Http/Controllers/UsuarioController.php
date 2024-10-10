<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{
    public function vista_usuario(){
        // Cargar usuarios junto con sus roles
        $usuarios = User::with('roles')->get();
        $roles = Role::all(); // Traer todos los roles disponibles
        return view('usuarios.index', ['usuarios' => $usuarios, 'roles' => $roles]);
    }

    public function eliminar_usuario($id){
        $usuario = User::find($id);

        if($usuario){
            $usuario->delete();

            return redirect()->route('usuarios.index');
        }else{
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }
    }

    public function asignar_rol(Request $request, $id){
        $usuario = User::find($id);
        if($usuario){
            $usuario->syncRoles($request->input('roles')); // Sincroniza los roles seleccionados
            return redirect()->route('usuarios.index')->with('success', 'Roles actualizados correctamente.');
        }
        return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
    }

    public function crear_usuario(Request $request) {
        // Validar los campos del formulario
        $attributes = $request->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'phone' => ['nullable', 'string', 'max:15'], // Opcional
            'location' => ['nullable', 'string', 'max:100'], // Opcional
            'about_me' => ['nullable', 'string', 'max:255'], // Opcional
        ]);

        // Encriptar la contraseña
        $attributes['password'] = bcrypt($attributes['password']);

        // Crear el usuario
        $user = User::create($attributes);

        // Autenticar al usuario
        Auth::login($user);

        // Redireccionar con mensaje de éxito
        return redirect('/dashboard')->with('success', 'El usuario ha sido creado correctamente.');
    }

}
