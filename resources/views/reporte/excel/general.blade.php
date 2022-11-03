<table>
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">No. DE PARTE</th>
            <th scope="col">DESCRIPCION</th>
            <th scope="col">Cantidad</th>
            <th scope="col">PARA UTILIZAR EN</th>
            <th scope="col">PROVEEDOR</th>
            <th scope="col">NIT</th>
            <th scope="col">FECHA</th>
            <th scope="col">VALE</th>
            <th scope="col">PRECIO UNITARIO</th>
            <th scope="col">PRECIO TOTAL</th>
            <th scope="col">AUTORIZADO POR</th>
            <th scope="col">ESTADO</th>
        </tr>
        </thead>
    <tbody>
    @foreach($reporte as $r)
        <tr>
            <th>{{$loop->iteration}}</th>
            <td>{{ $r->no_parte }}</td>
            <td>{{ $r->descripcion_parte }}</td>
            <td>{{ $r->cantidad }}</td>
            <td>{{ $r->equipo }}</td>
            <td>{{ $r->proveedor }}</td>
            <td>{{ $r->nit }}</td>
            <td>{{date("d-m-Y",strtotime($r->fecha_vale))}}</td>
            <td>{{$r->vale}}</td>
            <td>Q. {{number_format($r->costo_unitario,2)}}</td>
            <td>Q. {{number_format($r->costo_unitario * $r->cantidad,2)}}</td>
            <td>Angel Pineda / Luis Pedro Urrutia</td>
            <td>
                @if($r->estado)
                    {{ $r->estado }}
                @else
                    SIN PAGAR
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
