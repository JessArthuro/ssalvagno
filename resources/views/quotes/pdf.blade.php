<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cotización {{ $quote->num_cotizacion }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td>
                    <img src="logo.png" alt="" style="height: 8rem;">
                </td>
                <td class="text-center">
                    <h4><small>SERVICIOS INTEGRALES SALVAGNO</small></h4>
                    <h6><small>RFC: SARD670119EG0</small></h6>
                    <h6><small>DINA MARTHA SALVAÑO REJON</small></h6>
                    <h6><small>Calle 19 No. 3 A Col. Guanal, Ciudad del Carmen, Camp.</small></h6>
                    <h6><small>Tel. 9381083462 y 9381511405</small></h6>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-sm">
        <tbody>
            <tr>
                <td colspan="2" class="pl-3"><small>Fecha:
                        {{ date('d-m-Y', strtotime($quote->fecha_cot)) }}</small></td>
            </tr>
            <tr>
                <td colspan="2" class="pl-3"><small>No De Cotización: {{ $quote->num_cotizacion }}</small></td>
            </tr>
            @if ($quote->num_orden)
                <tr>
                    <td colspan="2" class="pl-3"><small>No De Orden de Compra: {{ $quote->num_orden }}</small></td>
                </tr>
            @endif
            <tr>
                <td colspan="2" class="pl-3"><small>Nombre: {{ $quote->nombre }}</small></td>
            </tr>
            <tr>
                <td colspan="2" class="pl-3"><small>Empresa: {{ $quote->empresa->nombre }}</small></td>
            </tr>
            <tr>
                <td colspan="2" class="pl-3"><small>Fecha de Entrega:
                        {{ date('d-m-Y', strtotime($quote->fecha_ent)) }}</small>
                </td>
            </tr>
            <tr>
                <td class="pl-3"><small>Lugar de Entrega: {{ $quote->lugar_ent }}</small></td>
                <td class="pl-3"><small>Hora: {{ $quote->hora_ent }}</small></td>
            </tr>
            <tr>
                <td colspan="2" class="pl-3" style="height: 65px;"><small>Nombre y Firma de Quien Recibe:</small>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered table-sm mt-5">
        <thead class="table-dark">
            <tr>
                <th class="text-light text-center"><small>Servicio</small></th>
                <th class="text-light text-center"><small>Cantidad</small></th>
                <th class="text-light text-center"><small>Precio Unitario</small></th>
                <th class="text-light text-center"><small>Total</small></th>
            </tr>
        </thead>
        <tbody>
            @php
                $subtotal = 0;
            @endphp

            @foreach ($quote->servicios as $serv)
                <tr>
                    <td class="pl-3">
                        <small>Servicio de Alimentos:</small>
                        @foreach ($serv->servicio as $index => $food)
                            <span><small>{{ $food }}</small></span>
                            @if (!$loop->last && count($serv->servicio) > 1)
                                -
                            @endif
                        @endforeach
                        <br>
                        <small>Fecha: {{ date('d-m-Y', strtotime($serv->fecha_serv)) }}</small> <br>
                        <small>Huesped: <span class="text-capitalize">{{ $serv->huesped }}</span></small>
                    </td>
                    <td class="text-center"><small>{{ $serv->cantidad }}</small></td>
                    <td class="text-center"><small>${{ $serv->precio_unitario }}</small></td>
                    <td class="text-center"><small>${{ $serv->total }}</small></td>
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
                <td colspan="3" class="text-right"><small>Subtotal</small></td>
                <td class="text-center"><small>${{ number_format($subtotal, 2) }}</small></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><small>IVA</small></td>
                <td class="text-center"><small>${{ number_format($iva, 2) }}</small></td>
            </tr>
            <tr>
                <td colspan="3" class="text-right"><small>Total</small></td>
                <td class="text-center"><small>${{ number_format($total, 2) }}</small></td>
            </tr>
        </tbody>
    </table>
</body>

</html>
