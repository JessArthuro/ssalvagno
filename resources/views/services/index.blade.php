@extends('layouts.master')

@section('content')
  <div class="d-flex justify-content-between mt-3 mb-5">
    <h3>Lista de Servicios</h3>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-hover text-center pt-3" id="example">
            <thead>
                <tr class="table-dark">
                    <th class="text-light text-center">ID</th>
                    <th class="text-light text-center">Cotizacion</th>
                    <th class="text-light text-center">Servicio</th>
                    <th class="text-light text-center">Huesped</th>
                    <th class="text-light text-center">Total</th>
                    <th class="text-light text-center">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->cotizacion_id }}</td>
                        <td>{{ $service->servicio }}</td>
                        <td>{{ $service->huesped }}</td>
                        <td>{{ $service->total }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection