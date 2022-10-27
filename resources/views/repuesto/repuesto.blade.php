@extends('adminlte::page')

@section('title', 'Repuestos')

@section('content_header')
    <h1>Repuestos</h1>
@stop

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-3">
        <a href="{{route('repuesto.crear')}}">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-info">Crear Repuesto</button>
            </div>
        </a>
    </div>
       <div class="table-responsive">
           <table class="table text-center table-responsive-md tabla_informacion">
               @if(count($repuestos))
                   <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col">Item</th>
                       <th scope="col">Nombre de Repuesto</th>
                       <th scope="col">Ubicacion</th>
                       <th scope="col">Opcion</th>
                   </tr>
                   </thead>
               @endif
               <tbody>
               @forelse($repuestos as $repuesto)
                   <tr class="font-weight-bold">
                       <th>{{$loop->iteration}}</th>
                       <td>{{$repuesto->item}}</td>
                       <td>{{$repuesto->nombre}}</td>
                       <td>{{$repuesto->ubicacion_bodega}}</td>

                       <td>
                           <a href="{{route('repuesto.editar',['repuesto'=>encrypt($repuesto->item)] )}}">
                               <button type="button" class="btn btn-outline-info"><i class="fas fa-edit"></i></button>
                           </a>
                         {{--  <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{$repuesto->item}})"><i class="fas fa-trash"></i></button>--}}
                       </td>
                   </tr>
               @empty
                   <p>No hay repuestos</p>
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
