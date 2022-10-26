@extends('adminlte::page')

@section('title', 'Editar Equipo')

@section('content_header')
    <h1>Editar Equipo</h1>
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
            <form action="{{route('equipo.actualizar',$equipo->id)}}" method="post">
                @csrf
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="equipo">Equipo</label>
                        <input class="form-control String" type="text" name="equipo" id="equipo" value="{{old('equipo',$equipo->equipo)}}" maxlength="40" required="required">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="unidad">Unidad</label>
                        <input class="form-control String" type="text" name="unidad" id="unidad" value="{{old('unidad',$equipo->unidad)}}" maxlength="10" required="required">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="placa">Placa</label>
                        <input class="form-control String" type="text" name="placa" id="placa" value="{{old('placa',$equipo->placa)}}" maxlength="10" required="required">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="tipo">Tipo</label>
                        <input class="form-control String" type="text" name="tipo" id="tipo" value="{{old('tipo',$equipo->tipo)}}" maxlength="40" required="required">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="ubicacion">Ubicacion</label>
                        <input class="form-control String" type="text" name="ubicacion" id="ubicacion" value="{{old('ubicacion',$equipo->ubicacion)}}" maxlength="13" required="required">
                    </div>

                    <div class="form-group">
                        <label for="tipo_operacion">Tipo de Operacion</label>
                        <select class="form-control" name="tipo_operacion" id="tipo_operacion">
                            @foreach($tipoOperacion as $to)
                                <option value="{{$to->idtipo_operacion}}" @if($equipo->tipo_operacion_idtipo_operacion == $to->idtipo_operacion) selected @endif  >{{$to->operacion}}</option>
                            @endforeach
                        </select>
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
