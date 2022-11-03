@extends('adminlte::page')

@section('title', 'Terrestres Carbay')

@section('css')
    <style>
    .chart{
        vertical-align: middle;
        width: 100%;
        margin: 0 auto;
        position: relative;
        display: inline-block;

    }
    canvas{
         height: 100%;
         display: block;
    }
    </style>
@endsection

@section('content_header')
    <h1>DASHBOARD</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row p-2">
        <div class="card col-md-6">
            <div class="card-body">
                <div class="card-title">
                    Gastos por Operacion
                </div>
                <canvas id="porOperacion" class="chart"></canvas>
            </div>
        </div>
        <div class="card col-md-6">
            <div class="card-body">
                <div class="card-title">
                    Por Equipo
                </div>
                <div class="table-responsive">
                    <table class="table text-center table-responsive-md tabla_informacion">
                        @if(count($porEquipo))
                            <thead>
                            <tr>
                                <th scope="col">Equipo</th>
                                <th scope="col">Total</th>
                            </thead>
                        @endif
                        <tbody>
                        @forelse($porEquipo as $pe)
                            <tr class="font-weight-bold">
                                <th>{{$pe->equipo}}</th>
                                <td>Q. {{number_format($pe->total,2)}}</td>
                            </tr>
                        @empty
                            <p>No hay datos</p>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@stop


{{-- @section('css')
<style>
    .content-wrapper {
        background-image: url("https://cpn.gob.gt/xii-congreso-maritimo-portuario/images/slide-1.jpg");
    }
</style>
@stop --}}

@section('js')
<script>
    @include('chartsScript.porOperacion')
</script>

@stop
