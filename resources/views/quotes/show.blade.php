@extends('layouts.master')

@section('content')
    <table class="table table-bordered mt-3">
        <tbody>
            <tr>
                <td colspan="2">Fecha: {{ date('d-m-Y', strtotime($quote->fecha_cot)) }}</td>
            </tr>
            <tr>
                <td colspan="2">No De Cotización: {{ $quote->num_cotizacion }}</td>
            </tr>
            @if ($quote->num_orden)
                <tr>
                    <td colspan="2">No De Orden de Compra: {{ $quote->num_orden }}</td>
                </tr>
            @endif
            <tr>
                <td colspan="2">Nombre: {{ $quote->nombre }}</td>
            </tr>
            <tr>
                <td colspan="2">Empresa: {{ $quote->empresa->nombre }}</td>
            </tr>
            <tr>
                <td colspan="2">Fecha de Entrega: {{ date('d-m-Y', strtotime($quote->fecha_ent)) }}</td>
            </tr>
            <tr>
                <td>Lugar de Entrega: {{ $quote->lugar_ent }}</td>
                <td>Hora: {{ $quote->hora_ent }}</td>
            </tr>
            <tr style="height: 5rem;">
                <td colspan="2">Nombre y Firma de Quien Recibe:</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered mt-8">
        <thead class="table-dark">
            <tr>
                <th class="text-light text-center">Servicio</th>
                <th class="text-light text-center">Cantidad</th>
                <th class="text-light text-center">Precio Unitario</th>
                <th class="text-light text-center">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quote->servicios as $serv)
                <tr>
                    <td>
                        Servicio de Alimentos:
                        @foreach ($serv->servicio as $index => $food)
                            <span>{{ $food }}</span>
                            @if (!$loop->last && count($serv->servicio) > 1)
                                -
                            @endif
                        @endforeach
                        <br>
                        Fecha: {{ date('d-m-Y', strtotime($serv->fecha_serv)) }} <br>
                        {{-- @php
                            \Carbon\Carbon::setLocale('es');
                        @endphp
                        Fecha: {{ \Carbon\Carbon::parse($serv->fecha_serv)->isoFormat('DD [de] MMMM [de] YYYY') }} <br> --}}
                        Huesped: <span class="text-capitalize">{{ $serv->huesped }}</span>
                    </td>
                    <td class="text-center">{{ $serv->cantidad }}</td>
                    <td class="text-center">{{ $serv->precio_unitario }}</td>
                    <td class="text-center">{{ $serv->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
