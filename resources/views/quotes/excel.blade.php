<table>
    <tbody>
        <tr></tr>
        <tr>
            <td></td>
            <td></td>
            {{-- <td><img src="marinsa_logo.png" alt=""></td> --}}
            {{-- <td colspan="4">ARQUEO SEMANAL DE ALIMENTOS</td> --}}
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>FOLIO</th>
            <th>FECHA ENTRADA</th>
            <th>FECHA SALIDA</th>
            <th>HUESPED</th>
            <th>CECO / <br>EMBARCACIÓN</th>
            <th>DESAYUNOS <br>TOTAL</th>
            <th>COMIDAS <br>TOTAL</th>
            <th>CENAS <br>TOTAL</th>
            <th>SOLICITA</th>
            <th>OBSERVACIONES</th>
        </tr>
    </thead>
    <tbody>
        @php
            $subCenas = 0;
            $envio = 0;

            $subtotalDesayunos = 0;
            $subtotalComidas = 0;
            $subtotalCenas = 0;
            $subtotal = 0;

            $ivaDesayunos = 0;
            $ivaComidas = 0;
            $ivaCenas = 0;
            $iva = 0;

            $totalDesayunos = 0;
            $totalComidas = 0;
            $totalCenas = 0;
            $total = 0;
        @endphp

        @foreach ($groupedHuespedes as $nombreHuesped => $datosHuesped)
            @php
                $servicioEnvio = 0;
            @endphp

            <tr>
                <td>{{ $quote->num_cotizacion }}</td>
                <td>{{ date('d-m-Y', strtotime($quote->fecha_ent)) }}</td>
                <td>{{ date('d-m-Y', strtotime($quote->fecha_sal)) }}</td>
                <td>{{ $nombreHuesped }}</td>
                <td>{{ $datosHuesped['embarcacion'] }}</td>

                @if ($datosHuesped['desayunos'] > 0)
                    <td>${{ number_format($datosHuesped['desayunos'], 2) }}</td>
                @else
                    <td></td>
                @endif

                @if ($datosHuesped['comidas'] > 0)
                    <td>${{ number_format($datosHuesped['comidas'], 2) }}</td>
                @else
                    <td></td>
                @endif

                @if ($datosHuesped['cenas'] > 0)
                    <td>${{ number_format($datosHuesped['cenas'], 2) }}</td>
                @else
                    <td></td>
                @endif

                <td>{{ $quote->nombre }}</td>

                @php
                    $totalAlimentos = $datosHuesped['desayunos'] + $datosHuesped['comidas'] + $datosHuesped['cenas'];

                    $subtotalDesayunos += $datosHuesped['desayunos'];
                    $subtotalComidas += $datosHuesped['comidas'];
                    $subCenas += $datosHuesped['cenas'];
                    $subtotalCenas = $subCenas + $envio;
                    $subtotal = $subtotalDesayunos + $subtotalComidas + $subtotalCenas;

                    $ivaDesayunos = $subtotalDesayunos * 0.16;
                    $ivaComidas = $subtotalComidas * 0.16;
                    $ivaCenas = $subtotalCenas * 0.16;
                    $iva = $subtotal * 0.16;
                    
                    $totalDesayunos = $subtotalDesayunos + $ivaDesayunos;
                    $totalComidas = $subtotalComidas + $ivaComidas;
                    $totalCenas = $subtotalCenas + $ivaCenas;
                    $total = $totalDesayunos + $totalComidas + $totalCenas;
                @endphp              

                <td>${{ number_format($totalAlimentos, 2) }}</td>
            </tr>

            @foreach ($quote->servicios as $serv)
                @php
                    $servicioEnvio += $serv->costo_envio;
                @endphp
            @endforeach


            @php
                $envio = $servicioEnvio;
            @endphp
        @endforeach

        @if ($envio > 0)
            <tr>
                <td></td><td></td><td></td><td></td>
                <td style="text-align: center; font-weight: bold;">Servicio de Entrega</td>
                <td></td><td></td>
                <td>${{ number_format($envio, 2) }}</td>                
            </tr>
        @endif
       
        <tr>
            <td></td><td></td><td></td><td></td>
            <td style="text-align: center; font-weight: bold;">Subtotal</td>
            <td>${{ number_format($subtotalDesayunos, 2) }}</td>
            <td>${{ number_format($subtotalComidas, 2) }}</td>
            <td>${{ number_format($subtotalCenas, 2) }}</td>
            <td>${{ number_format($subtotal, 2) }}</td>
        </tr>
        <tr>
            <td></td><td></td><td></td><td></td>
            <td style="text-align: center; font-weight: bold;">IVA</td>
            <td>${{ number_format($ivaDesayunos, 2) }}</td>
            <td>${{ number_format($ivaComidas, 2) }}</td>
            <td>${{ number_format($ivaCenas, 2) }}</td>
            <td>${{ number_format($iva, 2) }}</td>
        </tr>
        <tr>
            <td></td><td></td><td></td><td></td>
            <td style="text-align: center; font-weight: bold;">Total</td>
            <td>${{ number_format($totalDesayunos, 2) }}</td>
            <td>${{ number_format($totalComidas, 2) }}</td>
            <td>${{ number_format($totalCenas, 2) }}</td>
            <td>${{ number_format($total, 2) }}</td>
        </tr>
    </tbody>
</table>
