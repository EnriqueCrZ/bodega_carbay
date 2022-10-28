@extends('adminlte::page')

@section('title', 'Consumir Ingreso')

@section('content_header')
    <h1>Consumiendo Orden No. {{ $consumo->orden_trabajo }}</h1>
@stop

@section('content')
<div class="container">
    <div class="card">

        <div class="card-header">
            <div class="checkbox ml-3">
                <label>
                  <input type="checkbox" data-toggle="toggle" data-on="Activado" data-off="Desactivado" id="configuracionVale">
                  Vale Completo
                </label>
              </div>
        </div>
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
            <form action="{{route('consumo.guardarConsumo',$consumo->idconsumo)}}" method="POST" novalidate autocomplete="off">
                @csrf

                <div class="form-group" id="vale">

                </div>



                <div class="btn-group">
                    <button class="btn btn-outline-info" type="submit">Consumir</button>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-danger">Regresar</a>
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
        let toggle = $('#configuracionVale');
        $(document).ready(function(){
            toggle.bootstrapToggle('on');
            si();
        })

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        toggle.change(function(){
            $(this).prop('checked') ? si() : no();
        });


        function si(){
            $.ajax({
                type: 'POST',
                'url': '{{ route('consumo.consumido.no') }}',
                data: {foo: null},
                success: function (response){
                    $('#vale').html(response);
                }
            })
        }

        function no(){
            console.log('no');
        }
    </script>
@stop
