@extends('adminlte::page')

@section('title', 'Llantas')

@section('content_header')
    <h1>Llantas</h1>
@stop

@section('content')
    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-2">
        <a href="{{route('llanta.crear')}}">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-info">Crear registro</button>
            </div>
        </a>
    </div>
       <div class="table-responsive">
           <table class="table text-center table-responsive-md tabla_informacion">
               @if(count($llantas))
                   <thead>
                   <tr>
                       <th scope="col">#</th>
                       <th scope="col">Kilometraje</th>
                       <th scope="col">Cantidad</th>
                       <th scope="col">Descripcion/Quemado</th>
                       <th scope="col">Costo Unitario</th>
                       <th scope="col">Costo Total</th>
                       <th scope="col">Fecha de Instalacion</th>
                       <th scope="col">Marca</th>
                       <th scope="col">Movimiento</th>
                       <th scope="col">Operacion</th>
                       <th scope="col">Equipo</th>
                       <th scope="col">Proveedor</th>
                       <th scope="col">Coordinador</th>
                       <th scope="col">Vale</th>
                       <th scope="col">Opcion</th>
                   </tr>
                   </thead>
               @endif
               <tbody>
               @forelse($llantas as $llanta)
                   <tr class="font-weight-bold">
                       <th>{{$llanta->no_ot_vale}}</th>
                       <td>{{ $llanta->kilometraje }}</td>
                       <td>{{ $llanta->cantidad }}</td>
                       <td>{{ $llanta->descripcion_quemado }}</td>
                       <td nowrap>Q. {{ number_format($llanta->costo_unitario,2) }}</td>
                       <td nowrap>Q. {{ number_format($llanta->costo_total,2) }}</td>
                       <td>{{date("d-m-Y",strtotime($llanta->fecha_instalacion))}}</td>
                       <td>{{$llanta->marca}}</td>
                       <td>{{ $llanta->movimiento }}</td>
                       <td>{{ $llanta->operacion  }}</td>
                       <td>{{ $llanta->codigo_equipo }} - {{$llanta->equipo}}</td>
                       <td>{{ $llanta->nombre_proveedor }}</td>
                       <td>{{ $llanta->nombre_coordinador }}</td>
                       <td>{{ $llanta->vale }}</td>
                       <td>
                           <a href="{{route('llanta.editar',['llanta'=>$llanta] )}}">
                               <button type="button" class="btn btn-outline-info"><i class="fas fa-edit"></i></button>
                           </a>
                           {{-- <button type="button" class="btn btn-outline-danger" onclick="confirmDelete({{$equipo->id}})"><i class="fas fa-trash"></i></button> --}}
                       </td>
                   </tr>
               @empty
                   <p>No hay datos para mostrar</p>
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
