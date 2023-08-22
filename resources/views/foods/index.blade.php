@extends('layouts.master')

@section('css')
    <style>
        .dropdown-toggle::before {
            display: none !important;
        }
    </style>
@endsection

@section('content')
    <section class="px-5 py-4 mb-5">
        <div class="d-flex justify-content-between mt-3 mb-5">
            <h3>Lista de Alimentos</h3>
            <a href="{{ route('foods.create') }}" class="btn btn-primary"><i class="las la-plus"></i> Nuevo Alimento</a>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-hover text-center pt-3" id="example">
                    <thead>
                        <tr class="table-dark">
                            <th class="text-light text-center">Nombre</th>
                            <th class="text-light text-center">Precio</th>
                            <th class="text-light text-center">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($foods as $food)
                            <tr>
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
                                                <form action="{{ route('foods.destroy', $food) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit">
                                                        <i data-feather="trash" class="nav-icon icon-xs me-1">
                                                        </i>
                                                        Eliminar
                                                    </button>
                                                </form>
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
    </section>
@endsection
