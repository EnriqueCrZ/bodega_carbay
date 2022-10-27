@extends('adminlte::page')

@section('title', 'Registrar Consumo')

@section('content_header')
    <h1>Registrar Consumo</h1>
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
            <form action="{{route('consumo.almacenar')}}" method="POST" novalidate autocomplete="off">
                @csrf

                <div class="form-group">
                    <label for="fecha">Fecha de Orden</label>
                    <input class="form-control fecha" type="text" name="fecha" id="fecha"
                           value="{{old('fecha')}}" required="required"
                    >
                    @if($errors->has('fecha'))
                        <p class="text-danger">{{$errors->first('fecha')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="orden">No. de Orden</label>
                    <input class="form-control String" type="text" name="orden" id="orden"
                           value="{{old('orden')}}" required="required"
                    >
                    @if($errors->has('orden'))
                        <p class="text-danger">{{$errors->first('orden')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="cantidad_devuelto">Cantidad Devuelto</label>
                    <input class="form-control int" type="text" name="cantidad_devuelto" id="cantidad_devuelto"
                           value="{{old('cantidad_devuelto')}}">
                    @if($errors->has('cantidad_devuelto'))
                        <p class="text-danger">{{$errors->first('cantidad_devuelto')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="cantidad_chatarra">Cantidad Chatarra</label>
                    <input class="form-control int" type="text" name="cantidad_chatarra" id="cantidad_chatarra"
                           value="{{old('cantidad_chatarra')}}">
                    @if($errors->has('cantidad_chatarra'))
                        <p class="text-danger">{{$errors->first('cantidad_chatarra')}}</p>
                    @endif
                </div>


                <div class="form-group">
                    <label for="equipo">Equipo</label>
                    <select name="equipo" class="form-control selector" id="equipo">
                        @foreach ($equipos as $e)
                            <option value="{{ $e->id }}">{{ $e->id }} - {{ $e->equipo }}</option>
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
<script>
    $(".int").on("keyup paste",function(){
        let valid = /^\d{0,3}?$/.test(this.value), val = this.value;

        if(!valid){
            this.value = val.substring(0, val.lenght - 1);

        }

    })


    $(".selector").select2({
        allowClear: true
    });
</script>
@stop
