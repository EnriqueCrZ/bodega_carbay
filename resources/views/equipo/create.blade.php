@extends('adminlte::page')

@section('title', 'Crear Equipo')

@section('content_header')
    <h1>Crear Equipo</h1>
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
            <form action="{{route('equipo.almacenar')}}" method="POST" novalidate>
                @csrf

                <div class="form-group">
                    <label for="id">ID de Equipo</label>
                    <input class="form-control String" type="text" name="id" id="id"
                           value="{{old('id')}}" maxlength="5"
                           required="required">
                    @if($errors->has('nombre'))
                        <p class="text-danger">{{$errors->first('id')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="equipo">Equipo</label>
                    <input class="form-control String" type="text" name="equipo" id="equipo"
                           value="{{old('equipo')}}" required="required" maxlength="40"
                    >
                    @if($errors->has('nombre'))
                        <p class="text-danger">{{$errors->first('equipo')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="unidad">Unidad</label>
                    <input class="form-control String" type="text" name="unidad" id="unidad"
                           value="{{old('unidad')}}" maxlength="10"
                           required="required">
                    @if($errors->has('nombre'))
                        <p class="text-danger">{{$errors->first('unidad')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="placa">Placa</label>
                    <input class="form-control String" type="text" name="placa" id="placa"
                           value="{{old('placa')}}" maxlength="10"
                    >
                    @if($errors->has('placa'))
                        <p class="text-danger">{{$errors->first('placa')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input class="form-control String" type="text" name="tipo" id="tipo"
                           value="{{old('tipo')}}" maxlength="40"
                    >
                    @if($errors->has('tipo'))
                        <p class="text-danger">{{$errors->first('tipo')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="ubicacion">Ubicacion</label>
                    <input class="form-control String" type="text" name="ubicacion" id="ubicacion"
                           value="{{old('ubicacion')}}" maxlength="13"
                    >
                    @if($errors->has('ubicacion'))
                        <p class="text-danger">{{$errors->first('ubicacion')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="tipo_operacion">Tipo de Operacion</label>
                    <select name="tipo_operacion" class="form-control" id="tipo_operacion">
                        @foreach ($tipoOperacion as $to)
                            <option value="{{ $to->idtipo_operacion }}">{{ $to->operacion }}</option>
                        @endforeach
                    </select>

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
