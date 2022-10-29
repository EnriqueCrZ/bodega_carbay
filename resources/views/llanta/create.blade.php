@extends('adminlte::page')

@section('title', 'Llantas')

@section('content_header')
    <h1>Crear registro</h1>
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
            <form action="{{route('llanta.almacenar')}}" method="POST" novalidate autocomplete="off">
                @csrf

                <div class="form-group">
                    <label for="no_ot_vale">No. OT/Vale</label>
                    <input class="form-control String" type="text" name="no_ot_vale" id="no_ot_vale"
                           value="{{old('no_ot_vale')}}" required="required"
                    >
                    @if($errors->has('no_ot_vale'))
                        <p class="text-danger">{{$errors->first('no_ot_vale')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="kilometraje">Kilometraje</label>
                    <input class="form-control String" type="text" name="kilometraje" id="kilometraje"
                           value="{{old('kilometraje')}}"
                    >
                    @if($errors->has('kilometraje'))
                        <p class="text-danger">{{$errors->first('kilometraje')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="descripcion_quemado">Descripcion/Quemado</label>
                    <input class="form-control String" type="text" name="descripcion_quemado" id="descripcion_quemado"
                           value="{{old('descripcion_quemado')}}" required="required" maxlength="100"
                    >
                    @if($errors->has('descripcion_quemado'))
                        <p class="text-danger">{{$errors->first('descripcion_quemado')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input class="form-control String" type="text" name="cantidad" id="cantidad"
                           value="{{old('cantidad')}}" maxlength="10"
                           required="required">
                    @if($errors->has('cantidad'))
                        <p class="text-danger">{{$errors->first('cantidad')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="costo_unitario">Costo Unitario</label>
                    <input class="form-control String" type="text" name="costo_unitario" id="costo_unitario"
                           value="{{old('costo_unitario')}}" maxlength="20"
                    >
                    @if($errors->has('costo_unitario'))
                        <p class="text-danger">{{$errors->first('costo_unitario')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="costo_total">Costo Total</label>
                    <input class="form-control String" type="text" name="costo_total" id="costo_total"
                           value="{{old('costo_total')}}" maxlength="40" onkeydown="return false"
                    >
                    @if($errors->has('costo_total'))
                        <p class="text-danger">{{$errors->first('costo_total')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha de Instalacion</label>
                    <input class="form-control fecha" type="text" name="fecha" id="fecha"
                           value="{{old('fecha')}}" required="required"
                    >
                    @if($errors->has('fecha'))
                        <p class="text-danger">{{$errors->first('fecha')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input class="form-control String" type="text" name="marca" id="marca"
                           value="{{old('marca')}}" required="required" maxlength="45"
                    >
                    @if($errors->has('marca'))
                        <p class="text-danger">{{$errors->first('marca')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="movimiento">Movimiento</label>
                    <input class="form-control String" type="text" name="movimiento" id="movimiento"
                           value="{{old('movimiento')}}" required="required" maxlength="45"
                    >
                    @if($errors->has('movimiento'))
                        <p class="text-danger">{{$errors->first('movimiento')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="operacion">Operacion</label>
                    <input class="form-control String" type="text" name="operacion" id="operacion"
                           value="{{old('operacion')}}" required="required" maxlength="45"
                    >
                    @if($errors->has('operacion'))
                        <p class="text-danger">{{$errors->first('operacion')}}</p>
                    @endif
                </div>

                <div class="form-group">
                    <label for="vale">Vale</label>
                    <input class="form-control String" type="text" name="vale" id="vale"
                           value="{{old('vale')}}" required="required" maxlength="20"
                    >
                    @if($errors->has('vale'))
                        <p class="text-danger">{{$errors->first('vale')}}</p>
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

                <div class="form-group">
                    <label for="proveedor">Proveedor</label>
                    <select name="proveedor" class="form-control selector" id="proveedor">
                        @foreach ($proveedores as $p)
                            <option value="{{ $p->id_proveedor }}">{{ $p->nombre_proveedor }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="coordinador">Coordinador</label>
                    <select name="coordinador" class="form-control selector" id="coordinador">
                        @foreach ($coordinadores as $c)
                            <option value="{{ $c->idcoordinador }}">{{ $c->nombre_coordinador }}</option>
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
    $('.integer').on("keyup paste",function(){
        let valid = /^\d{0,6}?$/.test(this.value), val = this.value;

        if(!valid){
            this.value = val.substring(0, val.lenght - 1);

        }
    })


    $("#cantidad").on("keyup paste",function(){
        let valid = /^\d{0,3}?$/.test(this.value), val = this.value;

        if(!valid){
            this.value = val.substring(0, val.lenght - 1);

        }
        calculate();
    })

    $("#costo_unitario").on("keyup paste",function(){
        let valid = /^\d{0,4}(\.\d{0,2})?$/.test(this.value), val= this.value;

        if(!valid){
            this.value = val.substring(0, val.lenght - 1);

        }

        calculate();

    });

    function calculate(){
        let cantidad = $("#cantidad").val();
        let costo_unitario = $("#costo_unitario").val();
        total = cantidad && costo_unitario ? cantidad * costo_unitario : "0"; // Calcula el total si la cantidad y costo unitario tienen valor
        $("#costo_total").val(total);
    }

    $(".selector").select2({
        allowClear: true
    });
</script>
@stop
