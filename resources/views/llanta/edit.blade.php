@extends('adminlte::page')

@section('title', 'Editar Registro')

@section('content_header')
    <h1>Editar Registro</h1>
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
            <form action="{{route('llanta.actualizar',$llanta->no_ot_vale)}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="kilometraje">Kilometraje</label>
                    <input class="form-control String" type="text" name="kilometraje" id="kilometraje"
                           value="{{old('kilometraje',$llanta->kilometraje)}}"
                    >
                </div>

                <div class="form-group">
                    <label for="descripcion_quemado">Descripcion/Quemado</label>
                    <input class="form-control String" type="text" name="descripcion_quemado" id="descripcion_quemado"
                           value="{{old('descripcion_quemado',$llanta->descripcion_quemado)}}" required="required" maxlength="100"
                    >
                </div>

                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input class="form-control String" type="text" name="cantidad" id="cantidad"
                           value="{{old('cantidad',$llanta->cantidad)}}" maxlength="10"
                           required="required">
                </div>

                <div class="form-group">
                    <label for="costo_unitario">Costo Unitario</label>
                    <input class="form-control String" type="text" name="costo_unitario" id="costo_unitario"
                           value="{{old('costo_unitario',$llanta->costo_unitario)}}" maxlength="20"
                    >
                </div>

                <div class="form-group">
                    <label for="costo_total">Costo Total</label>
                    <input class="form-control String" type="text" name="costo_total" id="costo_total"
                           value="{{old('costo_total',$llanta->costo_total)}}" maxlength="40" onkeydown="return false"
                    >
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha de Instalacion</label>
                    <input class="form-control fecha" type="text" name="fecha" id="fecha"
                           value="{{old('fecha',date('d-m-Y',strtotime($llanta->fecha_instalacion)))}}" required="required"
                    >
                </div>

                <div class="form-group">
                    <label for="marca">Marca</label>
                    <input class="form-control String" type="text" name="marca" id="marca"
                           value="{{old('marca',$llanta->marca)}}" required="required" maxlength="45"
                    >
                </div>

                <div class="form-group">
                    <label for="movimiento">Movimiento</label>
                    <input class="form-control String" type="text" name="movimiento" id="movimiento"
                           value="{{old('movimiento',$llanta->movimiento)}}" required="required" maxlength="45"
                    >
                </div>

                <div class="form-group">
                    <label for="operacion">Operacion</label>
                    <input class="form-control String" type="text" name="operacion" id="operacion"
                           value="{{old('operacion',$llanta->operacion)}}" required="required" maxlength="45"
                    >
                </div>

                <div class="form-group">
                    <label for="vale">Vale</label>
                    <input class="form-control String" type="text" name="vale" id="vale"
                           value="{{old('vale',$llanta->vale)}}" required="required" maxlength="20"
                    >
                </div>


                <div class="form-group">
                    <label for="equipo">Equipo</label>
                    <select name="equipo" class="form-control selector" id="equipo">
                        @foreach ($equipos as $e)
                            <option value="{{ $e->id }} @if($e->id == $llanta->equipo_id) selected @endif">{{ $e->id }} - {{ $e->equipo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="proveedor">Proveedor</label>
                    <select name="proveedor" class="form-control selector" id="proveedor">
                        @foreach ($proveedores as $p)
                            <option value="{{ $p->id_proveedor }} @if($p->id_proveedor == $llanta->proveedor_id_proveedor) selected @endif">{{ $p->nombre_proveedor }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="coordinador">Coordinador</label>
                    <select name="coordinador" class="form-control selector" id="coordinador">
                        @foreach ($coordinadores as $c)
                            <option value="{{ $c->idcoordinador }} @if($c->idcoordinador == $llanta->coordinador_idcoordinador) selected @endif">{{ $c->nombre_coordinador }}</option>
                        @endforeach
                    </select>
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
