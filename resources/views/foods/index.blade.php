@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between mt-3 mb-5">
        <h3>Lista de Alimentos</h3>
        <a href="{{ route('foods.create') }}" class="btn btn-primary">+ Nuevo Alimento</a>
    </div>

    <style>
        .dropdown-toggle::before {
            display: none !important;
        }
    </style>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover text-center pt-3" id="example">
                <thead>
                    <tr class="table-dark">
                        <th class="text-light text-center">ID</th>
                        <th class="text-light text-center">Nombre</th>
                        <th class="text-light text-center">Precio</th>
                        <th class="text-light text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($foods as $food)
                        <tr>
                            <td>{{ $food->id }}</td>
                            <td class="text-capitalize">{{ $food->nombre }}</td>
                            <td>${{ $food->precio }}</td>
                            <td>
                                <div class="btn-group dropstart">
                                    <button class="btn rounded-circle btn-icon btn-sm dropdown-toggle" type="button"
                                        id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false"
                                        style="box-shadow: none;">
                                        <i data-feather="more-vertical" class="icon-xs"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                        <li>
                                            <a href="{{ route('foods.edit', $food) }}" class="dropdown-item">
                                                <i data-feather="edit" class="nav-icon icon-xs me-1">
                                                </i>
                                                Editar
                                            </a>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" type="button">
                                                <i data-feather="trash" class="nav-icon icon-xs me-1">
                                                </i>
                                                Eliminar
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
