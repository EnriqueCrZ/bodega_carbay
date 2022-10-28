@extends('adminlte::page')

@section('title', 'Consumos')

@section('content_header')
    <h1>Consumos</h1>
@stop

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-2">
        <a href="{{route('consumo.crear')}}">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-info">Crear Consumo</button>
            </div>
        </a>
    </div>
       <div class="table-responsive">
           <table class="table text-center table-responsive-md tabla_informacion">
               @if(count($consumos))
                   <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col">Fecha de Orden</th>
                       <th scope="col">No. de Orden</th>
                       <th scope="col">Unidad</th>
                       <th scope="col">Cantidad Devuelto</th>
                       <th scope="col">Cantidad Chatarra</th>
                       <th scope="col">Opciones</th>
                       <th scope="col">Detalles</th>
                   </tr>
                   </thead>
               @endif
               <tbody>
               @forelse($consumos as $consumo)
                   <tr class="font-weight-bold">
                       <th>{{$loop->iteration}}</th>
                       <td>{{date("d-m-Y",strtotime($consumo->fecha))}}</td>
                       <td>{{$consumo->orden_trabajo}}</td>
                       <td>{{ $consumo->codigo_equipo }} - {{ $consumo->equipo }}</td>
                       <td>{{$consumo->cantidad_devuelto}}</td>
                       <td>{{$consumo->cantidad_chatarra}}</td>
                       <td>
                           <a href="{{route('consumo.editar',['consumo'=>$consumo] )}}">
                               <button type="button" class="btn btn-outline-info"><i class="fas fa-edit"></i></button>
                           </a>
                            <a href="{{ route('consumo.consumir',['consumo'=>$consumo]) }}">
                                <button type="button" class="btn btn-outline-danger" @if(validarConsumo($consumo)) disabled @endif><i class="fas fa-tools"></i></button>
                            </a>
                           {{-- <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{$equipo->id}})"><i class="fas fa-trash"></i></button> --}}
                       </td>
                       <td>
                            @if(validarConsumo($consumo))
                                <a href="#">
                                    <button type="button" class="btn btn-outline-primary" onclick="detallesOrden({{ $consumo->idconsumo }})">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </a>
                            @else
                                Sin consumir
                            @endif
                       </td>
                   </tr>
               @empty
                   <p>No hay consumos</p>
               @endforelse
               </tbody>
           </table>
       </div>
       <div class="modal-response"></div>

@stop

@section('css')

@stop

@section('js')
    <script>
        function detallesOrden(id){
            $.ajax({
                type: 'POST',
                url: '{{ route('consumo.detalles') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response){
                    $('.modal-response').html(response);
                    $('#modalConsumo').modal('show');
                }
            })
        }
    </script>
@stop
