@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>Proveedores</h1>
@stop

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div>
        <a href="{{route('proveedor.crear')}}">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-info">Crear Proveedor</button>
            </div>
        </a>
    </div>
       <div class="table-responsive">
           <table class="table text-center table-responsive-md">
               @if(count($proveedores))
                   <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col">NIT</th>
                       <th scope="col">Nombre de Proveedor</th>
                       <th scope="col">Observacion</th>
                       <th scope="col">Opcion</th>
                   </tr>
                   </thead>
               @endif
               <tbody>
               @forelse($proveedores as $proveedor)
                   <tr class="font-weight-bold">
                       <th>{{$proveedor->id_proveedor}}</th>
                       <td>{{$proveedor->nit}}</td>
                       <td>{{$proveedor->nombre_proveedor}}</td>
                       <td>{{$proveedor->observacion}}</td>
                       <td>
                           <a href="{{route('proveedor.editar',['proveedor'=>$proveedor] )}}">
                               <button type="button" class="btn btn-outline-info"><i class="fas fa-edit"></i></button>
                           </a>
                           <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{$proveedor->id_proveedor}})"><i class="fas fa-trash"></i></button>
                       </td>
                   </tr>
               @empty
                   <p>No hay proveedores</p>
               @endforelse
               </tbody>
           </table>
       </div>
       <div class="">
           {{ $proveedores->links('vendor.pagination.simple-bootstrap-4') }}
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
