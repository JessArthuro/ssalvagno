@extends('layouts.master')

@section('content')
    <section class="mt-3 mb-6">
        <div class="d-flex gap-2 flex-wrap mb-3">
            <a href="{{ route('quotes.index') }}" class="btn btn-secondary"><i data-feather="arrow-left"
                    class="nav-icon icon-xs">
                </i> Volver</a>
            <a href="{{ route('generate_pdf', $quote) }}" class="btn btn-outline-danger" target="_blank">Generar PDF</a>
            <a href="#" class="btn btn-outline-success">Generar Excel</a>
        </div>

        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td>
                        <img src="{{ asset('logo.png') }}" alt="" style="height: 10rem;">
                    </td>
                    <td class="text-center">
                        <h2>SERVICIOS INTEGRALES SALVAGNO</h2>
                        <h4>RFC: SARD670119EG0</h4>
                        <h4>DINA MARTHA SALVAÑO REJON</h4>
                        <h4>Calle 19 No. 3 A Col. Guanal, Ciudad del Carmen, Camp.</h4>
                        <h4>Tel. 9381083462 y 9381511405</h4>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
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
                @php
                    $subtotal = 0;
                @endphp

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

                            Huesped: <span class="text-capitalize">{{ $serv->huesped }}</span>
                        </td>
                        <td class="text-center">{{ $serv->cantidad }}</td>
                        <td class="text-center">${{ $serv->precio_unitario }}</td>
                        <td class="text-center">${{ $serv->total }}</td>
                    </tr>

                    @php
                        $subtotal += $serv->total;
                    @endphp
                @endforeach

                @php
                    $iva = $subtotal * 0.16;
                @endphp

                @php
                    $total = $subtotal + $iva;
                @endphp
                <tr>
                    <td colspan="3" class="text-end">Subtotal</td>
                    <td class="text-center">${{ number_format($subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end">IVA</td>
                    <td class="text-center">${{ number_format($iva, 2) }}</td>
                </tr>
                <tr>
                    <td colspan="3" class="text-end">Total</td>
                    <td class="text-center">${{ number_format($total, 2) }}</td>
                </tr>
            </tbody>
        </table>
    </section>
@endsection
