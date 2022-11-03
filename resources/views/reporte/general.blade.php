@extends('adminlte::page')

@section('title', 'Terrestres Carbay')

@section('content_header')
    <h1>REPORTE</h1>
@stop

@section('content')

<div class="row">
    <div class="col col-md-10 mb-1 offset-1">
        <form action="{{route('reporte')}}">
            <div class="row">
                <div class="col-md-2">
                    <label for="from" class="text-uppercase">Desde</label>
                    <input type="text" name="from" id="from" class="form-control fecha" value="{{date('d-m-Y',strtotime($from))}}">
                </div>
                <div class="col-md-2">
                    <label for="to" class="text-uppercase">Hasta</label>
                    <input type="text" name="to" id="to" class="form-control fecha" value="{{date('d-m-Y',strtotime($to))}}">
                </div>

                <div class="col-md-4">
                    <label for="s">CONTENIDO</label>
                    <input type="text" class="form-control" name="s" id="s" value="{{$query}}">
                </div>

                <div class="col-md-2">
                    <br>
                    <button type="submit" class="btn mt-2 text-white" style="background-color: #007bff"><i class="fa fa-search"></i></button>
                </div>
                <div class="col-md-2 mt-2"><br>
                    <a href="{{route('reporte.excel')}}/{{encrypt($from)}}/{{encrypt($to)}}/{{$query}}" class="btn" {{--target="_blank"--}} style="background-color: #007bff; color: white">Exportar <i class="fas fa-cloud-download-alt"></i></a>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="table-responsive table-bordered table-striped">
    <table class="table text-center table-responsive-md">
        @if(count($reporte))
            <thead class="thead-dark">
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
        @endif
        <tbody>
        @forelse($reporte as $r)
            <tr class="font-weight-bold">
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
                <td nowrap>Q. {{number_format($r->costo_unitario * $r->cantidad,2)}}</td>
                <td>Angel Pineda / Luis Pedro Urrutia</td>
                <td>
                    @if($r->estado)
                        {{ $r->estado }}
                    @else
                        SIN PAGAR
                    @endif
                </td>
            </tr>
        @empty
            <p>No hay datos para mostrar</p>
        @endforelse
        </tbody>
    </table>
</div>
@stop


