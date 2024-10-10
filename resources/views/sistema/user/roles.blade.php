@extends('layouts.user_type.auth')

@section('content')
<button type="button" class="btn bg-gradient-primary">Primary</button>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h6>Administracion de Roles</h6>
                        <!-- Botón de Agregar Usuario -->
                        <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                            <i class="fas fa-plus me-2"></i>Nuevo
                        </button>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nombre</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        colspan="2">Acciones</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $rol)
                                    <tr>
                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $rol->id }}</span>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0">{{ $rol->name }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <form action="{{ route('roles.destroy', $rol->id) }}" method="POST"
                                                id="formEliminar-{{ $rol->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link text-danger text-gradient px-3 mb-0">
                                                    <i class="far fa-trash-alt me-2"></i>Eliminar
                                                </button>
                                            </form>
                                        </td>
                                        <td class="align-middle text-center">
                                            <!-- Botón para abrir el modal de edición -->
                                            <button type="button" class="btn btn-link text-dark px-3 mb-0"
                                                data-bs-toggle="modal" data-bs-target="#editRoleModal-{{ $rol->id }}">
                                                <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Editar
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Modal para editar el rol -->
                                    <div class="modal fade" id="editRoleModal-{{ $rol->id }}" tabindex="-1"
                                        aria-labelledby="editRoleModalLabel-{{ $rol->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editRoleModalLabel-{{ $rol->id }}">
                                                        Editar Rol {{ $rol->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('roles.update', $rol->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <!-- Campo de edición del nombre -->
                                                        <div class="mb-3">
                                                            <label for="name-{{ $rol->id }}"
                                                                class="form-label">Nombre</label>
                                                            <input type="text" class="form-control"
                                                                id="name-{{ $rol->id }}" name="name"
                                                                value="{{ $rol->name }}" required>
                                                        </div>

                                                        <!-- Lista de permisos con checkboxes -->
                                                        <div class="mb-3">
                                                            <label class="form-label">Permisos</label>
                                                            @foreach ($permisos as $permiso)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="permiso-{{ $permiso->id }}-{{ $rol->id }}"
                                                                        name="permissions[]" value="{{ $permiso->name }}"
                                                                        {{ $rol->permissions->contains($permiso) ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                        for="permiso-{{ $permiso->id }}-{{ $rol->id }}">
                                                                        {{ $permiso->name }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
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
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Nuevo Rol</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Campos del formulario -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="nombre" required
                                placeholder="Ingrese el nombre del rol">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
