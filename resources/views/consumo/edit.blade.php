@extends('adminlte::page')

@section('title', 'Editar Consumo')

@section('content_header')
    <h1>Editar Consumo</h1>
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
            <form action="{{route('consumo.actualizar',$consumo->idconsumo)}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="fecha">Fecha de Orden</label>
                    <input class="form-control fecha" type="text" name="fecha" id="fecha"
                           value="{{old('fecha',date('d-m-Y',strtotime($consumo->fecha)))}}" required="required"
                    >

                </div>

                <div class="form-group">
                    <label for="orden">No. de Orden</label>
                    <input class="form-control String" type="text" name="orden" id="orden"
                           value="{{old('orden',$consumo->orden_trabajo)}}" required="required"
                    >
                </div>

                <div class="form-group">
                    <label for="cantidad_devuelto">Cantidad Devuelto</label>
                    <input class="form-control int" type="text" name="cantidad_devuelto" id="cantidad_devuelto"
                           value="{{old('cantidad_devuelto',$consumo->cantidad_devuelto)}}">

                </div>

                <div class="form-group">
                    <label for="cantidad_chatarra">Cantidad Chatarra</label>
                    <input class="form-control int" type="text" name="cantidad_chatarra" id="cantidad_chatarra"
                           value="{{old('cantidad_chatarra',$consumo->cantidad_chatarra)}}">

                </div>


                <div class="form-group">
                    <label for="equipo">Equipo</label>
                    <select name="equipo" class="form-control selector" id="equipo">
                        @foreach ($equipos as $e)
                            <option value="{{ $e->id }}" @if($e->id == $consumo->equipo_id) selected @endif>{{ $e->id }} - {{ $e->equipo }}</option>
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
