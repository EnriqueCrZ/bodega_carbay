@extends('adminlte::page')

@section('title', 'Crear Proveedor')

@section('content_header')
    <h1>Crear Proveedor</h1>
@stop

@section('content')
<div class="container">
    <div class="card">

        {{--<div class="card-header">
            <div class="col-md-12 text-secondary d-flex justify-content-center text-blue text-uppercase">
                <h3>Crear proveedor</h3>
            </div>
        </div>--}}
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
            <form action="{{route('proveedor.almacenar')}}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="id_proveedor">ID de Proveedor</label>
                    <input class="form-control String" type="text" name="id_proveedor" id="id_proveedor"
                           value="{{old('id_proveedor')}}" maxlength="75"
                           required="required">
                    @if($errors->has('nombre'))
                        <p class="text-danger">{{$errors->first('id_proveedor')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="nit">NIT</label>
                    <input class="form-control String" type="text" name="nit" id="email"
                           value="{{old('nit')}}" required="required"
                    >
                    @if($errors->has('nit'))
                        <p class="text-danger">{{$errors->first('nit')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="nombre_proveedor">Nombre de Proveedor</label>
                    <input class="form-control String" type="text" name="nombre_proveedor" id="nombre_proveedor"
                           value="{{old('nombre_proveedor')}}" maxlength="75"
                           required="required">
                    @if($errors->has('nombre'))
                        <p class="text-danger">{{$errors->first('nombre_proveedor')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="observacion">Observacion</label>
                    <input class="form-control String" type="text" name="observacion" id="observacion"
                           value="{{old('observacion')}}"
                    >
                    @if($errors->has('observacion'))
                        <p class="text-danger">{{$errors->first('observacion')}}</p>
                    @endif
                </div>
                <div class="btn-group">
                    <button class="btn btn-outline-info" type="submit">Crear</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-danger">Regresar</a>
                </div>

            </form>
        </div>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
