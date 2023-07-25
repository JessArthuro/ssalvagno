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
                    @foreach ($quotes as $quote)
                    <tr>
                        <td>{{ $quote->id }}</td>
                        <td>{{ $quote->num_cotizacion }}</td>
                        <td class="text-capitalize">{{ $quote->nombre }}</td>
                        <td class="text-capitalize">{{ $quote->empresa->nombre }}</td>
                        <td>{{ date('d-m-Y', strtotime($quote->fecha_ent)) }}</td>
                        <td>
                            @include('layouts.partials.actions', [
                                'showAction' => route('quotes.show', $quote),
                                'editAction' => route('quotes.edit', $quote),
                                'deleteAction' => route('quotes.destroy', $quote)
                            ])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
