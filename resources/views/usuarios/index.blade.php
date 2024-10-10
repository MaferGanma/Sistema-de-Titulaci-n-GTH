@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">

                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h6>Tabla de usuarios</h6>
                        <!-- Botón de Agregar Usuario -->
                        <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fas fa-plus me-2"></i>Agregar Usuario
                        </button>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Email</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Roles
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        colspan="2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->name }}</td>
                                        <td>{{ $usuario->email }}</td>
                                        <td>
                                            <!-- Mostrar roles asignados al usuario -->
                                            @if ($usuario->roles->isNotEmpty())
                                                @foreach ($usuario->roles as $rol)
                                                    <span class="badge btn btn-info">{{ $rol->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-secondary">Sin roles</span>
                                            @endif
                                        </td>

                                        <td class="align-middle text-center">
                                            <!-- Formulario de eliminación -->
                                            <form action="{{ route('eliminar_usuario', $usuario->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link text-danger text-gradient px-3 mb-0"
                                                    onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">
                                                    <i class="far fa-trash-alt me-2"></i>Eliminar
                                                </button>
                                            </form>
                                        </td>

                                        <td class="align-middle text-center">
                                            <!-- Botón para editar roles -->
                                            <button type="button" class="btn btn-link text-dark px-3 mb-0"
                                                data-bs-toggle="modal" data-bs-target="#editRolesModal-{{ $usuario->id }}">
                                                <i class="fas fa-user-edit text-dark me-2"></i>Editar Roles
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal para editar roles -->
                                    <div class="modal fade" id="editRolesModal-{{ $usuario->id }}" tabindex="-1"
                                        aria-labelledby="editRolesModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editRolesModalLabel">Editar Roles de
                                                        {{ $usuario->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('asignar_rol', $usuario->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="roles" class="form-label">Roles
                                                                disponibles</label>
                                                            <div>
                                                                @foreach ($roles as $rol)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            id="rol_{{ $rol->id }}" name="roles[]"
                                                                            value="{{ $rol->name }}"
                                                                            @if ($usuario->hasRole($rol->name)) checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="rol_{{ $rol->id }}">
                                                                            {{ $rol->name }}
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar
                                                            cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Agregar Usuario -->
    <!-- Modal para Agregar Usuario -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('crear_usuario') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <!-- Campos del formulario -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Ubicación</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <div class="mb-3">
                            <label for="about_me" class="form-label">Sobre mí</label>
                            <textarea class="form-control" id="about_me" name="about_me"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary" onclick="soft.showSwal('success-message')">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
