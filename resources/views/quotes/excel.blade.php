<table>
    <tbody>
        <tr></tr>
        <tr>
            <td><img src="marinsa_logo.png" alt=""></td>
            <td colspan="4">ARQUEO SEMANAL DE ALIMENTOS</td>
        </tr>
    </tbody>
</table>

<table>
    <thead>
        <tr>
            <th>FOLIO</th>
            <th>HUESPED</th>
            <th>CECO / EMBARCACION</th>
            <th>SOLICITA</th>
            <th>OBSERVACIONES</th>
        </tr>
    </thead>
    <tbody>
        @php
            $subtotal = 0;
        @endphp

        @foreach ($services as $serv)
            <tr>
                <td>{{ $quote->num_cotizacion }}</td>
                <td>{{ $serv->huesped }}</td>
                <td>{{ $serv->embarcacion->nombre }}</td>
                <td>{{ $quote->nombre }}</td>
                <td>${{ $serv->total }}</td>
            </tr>

            @php
                $subtotal += $serv->total;
            @endphp
        @endforeach
        <tr>
            <td style="text-align: center;" colspan="4">Subtotal</td>
            <td>{{ number_format($subtotal, 2) }}</td>
        </tr>
    </tbody>
</table>
