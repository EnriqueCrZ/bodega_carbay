@extends('adminlte::page')

@section('title', 'Editar Proveedor')

@section('content_header')
    <h1>Editar Proveedor</h1>
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
            <form action="{{route('proveedor.actualizar',$proveedor->id_proveedor)}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="nit">NIT</label>
                        <input class="form-control String" type="text" name="nit" id="nit" value="{{old('nit',$proveedor->nit)}}" maxlength="15" required="required">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nombre_proveedor">Nombre de Proveedor</label>
                        <input class="form-control String" type="text" name="nombre_proveedor" id="nombre_proveedor" value="{{old('nombre_proveedor',$proveedor->nombre_proveedor)}}" maxlength="75">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-12 mb-3">
                        <label for="observacion">Observacion</label>
                        <input class="form-control String" type="text" name="observacion" id="observacion" value="{{old('observacion',$proveedor->observacion)}}" maxlength="90">
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
