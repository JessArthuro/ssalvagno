@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between mt-3 mb-5">
        <h3>Lista de Cotizaciones</h3>
        <a href="{{ route('quotes.create') }}" class="btn btn-primary">+ Nueva Cotización</a>
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
                        <th class="text-light text-center">No. Cotizacion</th>
                        <th class="text-light text-center">Nombre</th>
                        <th class="text-light text-center">Empresa</th>
                        <th class="text-light text-center">Fecha Entrega</th>
                        <th class="text-light text-center">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>215-2023</td>
                        <td>Lizeydi Manzano</td>
                        <td>Marinsa de México</td>
                        <td>20/07/2023</td>
                        <td>
                            <div class="btn-group dropstart">
                                <button class="btn rounded-circle btn-icon btn-sm dropdown-toggle" type="button"
                                    id="dropdownMenu" data-bs-toggle="dropdown" aria-expanded="false"
                                    style="box-shadow: none;">
                                    <i data-feather="more-vertical" class="icon-xs"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                    <li><button class="dropdown-item" type="button">Action</button></li>
                                    <li><button class="dropdown-item" type="button">Another action</button></li>
                                    <li><button class="dropdown-item" type="button">Something else here</button></li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>218-2023</td>
                        <td>Cristhel Baños Hernandez</td>
                        <td>Marinsa de México</td>
                        <td>25/07/2023</td>
                        <td><button class="btn btn-ghost btn-icon btn-sm rounded-circle">
                                <i data-feather="more-vertical" class="nav-icon icon-xs">
                                </i>
                            </button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
