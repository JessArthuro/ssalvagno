@extends('layouts.master')

@section('content')
    <div class="d-flex justify-content-between mt-3 mb-5">
        <h3>Lista de Cotizaciones</h3>
        <a href="#" class="btn btn-primary">+ Nueva Cotización</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover" id="example">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>No. Cotizacion</th>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>Fecha Entrega</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>215-2023</td>
                        <td>Lizeydi Manzano</td>
                        <td>Marinsa de México</td>
                        <td>20/07/2023</td>
                        <td><button class="btn btn-ghost btn-icon btn-sm rounded-circle">
                            <i data-feather="more-vertical" class="nav-icon icon-xs">
                            </i> 
                        </button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>218-2023</td>
                        <td>Lizeydi Manzano</td>
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
