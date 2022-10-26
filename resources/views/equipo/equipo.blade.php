@extends('adminlte::page')

@section('title', 'Equipos')

@section('content_header')
    <h1>Equipos</h1>
@stop

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div>
        <a href="{{route('equipo.crear')}}">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-info">Crear Equipo</button>
            </div>
        </a>
    </div>
       <div class="table-responsive">
           <table class="table text-center table-responsive-md">
               @if(count($equipos))
                   <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col"># Unidad</th>
                       <th scope="col">Equipo</th>
                       <th scope="col">Unidad</th>
                       <th scope="col">Placa</th>
                       <th scope="col">Tipo</th>
                       <th scope="col">Ubicacion</th>
                       <th scope="col">Tipo de Operacion</th>
                       <th scope="col">Opcion</th>
                   </tr>
                   </thead>
               @endif
               <tbody>
               @forelse($equipos as $equipo)
                   <tr class="font-weight-bold">
                       <th>{{$loop->iteration}}</th>
                       <td>{{$equipo->id}}</td>
                       <td>{{$equipo->equipo}}</td>
                       <td>{{$equipo->unidad}}</td>
                       <td>{{$equipo->placa}}</td>
                       <td>{{$equipo->tipo}}</td>
                       <td>{{$equipo->ubicacion}}</td>
                       <td>{{$equipo->tipo_operacion}}</td>
                       <td>
                           <a href="{{route('equipo.editar',['equipo'=>$equipo] )}}">
                               <button type="button" class="btn btn-outline-info"><i class="fas fa-edit"></i></button>
                           </a>
                           {{-- <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{$equipo->id}})"><i class="fas fa-trash"></i></button> --}}
                       </td>
                   </tr>
               @empty
                   <p>No hay equipos</p>
               @endforelse
               </tbody>
           </table>
       </div>
       <div class="">
           {{ $equipos->links('vendor.pagination.simple-bootstrap-4') }}
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
