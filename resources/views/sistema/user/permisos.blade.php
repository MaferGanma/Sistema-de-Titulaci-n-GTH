@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <h6>Administracion de Permisos</h6>
                        <!-- Botón de Agregar Usuario -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                            <i class="fas fa-plus me-2"></i>Nuevo Permiso
                        </button>
                    </div>
                </div>
                {{-- @if(session()->has('success'))
                <div x-data="{ show: true}"
                    x-init="setTimeout(() => show = false, 4000)"
                    x-show="show"
                    class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
                  <p class="m-0">{{ session('success')}}</p>
                </div>
              @endif --}}
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Id
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nombre
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                        colspan="2">
                                        Acciones
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permisos as $permiso)
                                    <tr>

                                        <td class="align-middle text-center text-sm">
                                            <span class="badge badge-sm bg-gradient-success">{{ $permiso->id }}</span>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0">{{ $permiso->name }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <form action="{{ route('permisos.destroy', $permiso->id) }}" method="POST"
                                                id="formEliminar-{{ $permiso->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link text-danger text-gradient px-3 mb-0">
                                                    <i class="far fa-trash-alt me-2"></i>Eliminar
                                                </button>
                                            </form>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-link text-dark px-3 mb-0" href="">
                                                <i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Editar
                                            </a>
                                        </td>
                                    </tr>
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
                    <h5 class="modal-title" id="addUserModalLabel">Nuevo Permiso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('permisos.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <!-- Campos del formulario -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="nombre" required
                                placeholder="Ingrese su permiso">
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
