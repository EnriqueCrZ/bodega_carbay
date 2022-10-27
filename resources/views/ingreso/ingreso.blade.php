@extends('adminlte::page')

@section('title', 'Ingresos')

@section('content_header')
    <h1>Ingresos</h1>
@stop

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-2">
        <a href="{{route('ingreso.crear')}}">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-info">Ingresar</button>
            </div>
        </a>
    </div>
       <div class="table-responsive">
           <table class="table text-center table-responsive-md tabla_informacion">
               @if(count($ingresos))
                   <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col">Fecha Vale</th>
                       <th scope="col">Vale</th>
                       <th scope="col">Cantidad</th>
                       <th scope="col">Costo Unitario</th>
                       <th scope="col">Costo Total</th>
                       <th scope="col">Item</th>
                       <th scope="col">Repuesto</th>
                       <th scope="col">NIT</th>
                       <th scope="col">Proveedor</th>
                       <th scope="col">Opcion</th>
                   </tr>
                   </thead>
               @endif
               <tbody>
               @forelse($ingresos as $ingreso)
                   <tr class="font-weight-bold">
                       <th>{{$loop->iteration}}</th>
                       <td>{{date("d-m-Y",strtotime($ingreso->fecha_vale))}}</td>
                       <td>{{$ingreso->vale}}</td>
                       <td>{{$ingreso->cantidad}}</td>
                       <td>Q. {{number_format($ingreso->costo_unitario,2)}}</td>
                       <td>Q. {{number_format($ingreso->costo_total,2)}}</td>
                       <td>{{$ingreso->item_repuesto}}</td>
                       <td>{{$ingreso->nombre_repuesto}}</td>
                       <td>{{$ingreso->nit_proveedor}}</td>
                       <td>{{$ingreso->nombre_proveedor}}</td>
                       <td>
                           <a href="{{route('ingreso.editar',['ingreso'=>$ingreso] )}}">
                               <button type="button" class="btn btn-outline-info"><i class="fas fa-edit"></i></button>
                           </a>
                           {{-- <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{$equipo->id}})"><i class="fas fa-trash"></i></button> --}}
                       </td>
                   </tr>
               @empty
                   <p>No hay ingresos</p>
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
