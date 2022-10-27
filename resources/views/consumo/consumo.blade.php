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
                       <th scope="col">Opcion</th>
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
                           {{-- <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{$equipo->id}})"><i class="fas fa-trash"></i></button> --}}
                       </td>
                   </tr>
               @empty
                   <p>No hay consumos</p>
               @endforelse
               </tbody>
           </table>
       </div>


@stop

@section('css')

@stop

@section('js')
    <script>
        function confirmDelete(id){
            console.log(id);
           /* Swal.fire({
                title: '¿Quieres eliminar el proveedor?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Eliminar',
                denyButtonText: `No eliminar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '{{route('proveedor.eliminar')}}',
                        data: {"id":id, "_token":'{{csrf_token()}}'},
                        success:function(data){
                            if(data){
                                Swal.fire('Eliminando...', '', 'success');
                                location.reload();
                            }else{
                                Swal.fire('Ocurrio un problema.', '', 'danger')
                            }
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Proveedor no eliminado', '', 'info')
                }
            })*/
        }
    </script>
@stop
