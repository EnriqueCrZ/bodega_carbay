@extends('adminlte::page')

@section('title', 'Editar Repuesto')

@section('content_header')
    <h1>Editar Repuesto</h1>
@stop

@section('content')
<div class="container">
    <div class="card">

        <div class="card-body">
            @if ( ! $errors->isEmpty() )
                <div class="row">
                    @foreach ( $errors->all() as $error )
                        <div class="col-md-6 col-md-offset-2 alert alert-danger">{{ $error }}</div>
                    @endforeach
                </div>
            @elseif ( Session::has( 'message' ) )
                <div class="row">
                    <div class="col-md-6 col-md-offset-2 alert alert-success">{{ Session::get( 'message' ) }}</div>
                </div>
            @else
                <p>&nbsp;</p>
            @endif
            <form action="{{route('repuesto.actualizar',encrypt($repuesto->item))}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre">Nombre</label>
                        <input class="form-control String" type="text" name="nombre" id="nombre" value="{{old('nombre',$repuesto->nombre)}}" maxlength="75" required="required">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="ubicacion_bodega">Ubicacion Bodega</label>
                        <input class="form-control String" type="text" name="ubicacion_bodega" id="ubicacion_bodega" value="{{old('ubicacion_bodega',$repuesto->ubicacion_bodega)}}" maxlength="10">
                    </div>
                </div>

                <div class="text-center">
                    <button class="btn btn-primary" type="submit">Actualizar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-danger">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
