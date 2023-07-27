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
        @foreach ($services as $serv)
            <tr>
                <td>{{ $quote->num_cotizacion }}</td>
                <td>{{ $serv->huesped }}</td>
                <td></td>
                <td>{{ $quote->nombre }}</td>
                <td>${{ $serv->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
