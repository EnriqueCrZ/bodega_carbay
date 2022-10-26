@extends('adminlte::page')

@section('title', 'Crear Repuesto')

@section('content_header')
    <h1>Crear Repuesto</h1>
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
            <form action="{{route('repuesto.almacenar')}}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="item">Item</label>
                    <input class="form-control String" type="text" name="item" id="item"
                           value="{{old('item')}}" maxlength="15"
                           required="required">
                    @if($errors->has('item'))
                        <p class="text-danger">{{$errors->first('item')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="nombre">Nombre de Repuesto</label>
                    <input class="form-control String" type="text" name="nombre" id="nombre"
                           value="{{old('nombre')}}" required="required"
                    >
                    @if($errors->has('nombre'))
                        <p class="text-danger">{{$errors->first('nombre')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="ubicacion_bodega">Ubicacion en Bodega</label>
                    <input class="form-control String" type="text" name="ubicacion_bodega" id="ubicacion_bodega"
                           value="{{old('ubicacion_bodega')}}" maxlength="10"
                           required="required">
                    @if($errors->has('ubicacion_bodega'))
                        <p class="text-danger">{{$errors->first('ubicacion_bodega')}}</p>
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
