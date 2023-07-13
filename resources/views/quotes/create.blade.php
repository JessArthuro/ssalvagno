@extends('layouts.master')

@section('content')
    <h3 class="mt-3 mb-5">Nueva Cotización</h3>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('quotes.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-4">
                    <label for="date" class="form-label">Fecha</label>
                    <input name="fecha" value="{{ date('Y-m-d') }}" type="date" class="form-control" id="date">
                </div>

                <div class="col-md-4">
                    <label for="quoteNum" class="form-label">No. Cotización</label>
                    <input name="num_cotizacion" type="text" class="form-control" id="quoteNum">
                </div>

                <div class="col-md-4">
                    <label for="numOrder" class="form-label">No. Orden</label>
                    <input name="num_orden" type="text" class="form-control" id="numOrder">
                </div>

                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre</label>
                    <input name="nombre" type="text" class="form-control" id="name">
                </div>

                <div class="col-md-6">
                    <label for="company" class="form-label">Empresa</label>
                    <select name="empresa" id="company" class="form-control">
                        <option selected disabled>Selecciona una opción...</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}">{{ $company->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="deliveryDate" class="form-label">Fecha de Entrega</label>
                    <input name="fecha_entrega" type="date" class="form-control" id="deliveryDate">
                </div>

                <div class="col-md-3">
                    <label for="deliveryTime" class="form-label">Hora de Entrega</label>
                    <input name="hora_entrega" type="time" class="form-control" id="deliveryTime">
                </div>

                <div class="col-md-6">
                    <label for="deliveryPlace" class="form-label">Lugar de Entrega</label>
                    <input name="lugar_entrega" type="text" class="form-control" id="deliveryPlace">
                </div>

                <div class="col-12 mt-5">
                    <div class="d-flex flex-wrap gap-2">
                        <button class="btn btn-primary" type="submit">Crear Cotización</button>
                        <div class="vr"></div>
                        <a href="{{ route('quotes.index') }}" class="btn btn-outline-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
