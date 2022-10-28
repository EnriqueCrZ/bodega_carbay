<div class="modal fade" id="modalConsumo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalles de Orden</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <table class="table table-hover table-striped table-bordered table-sm">
                        <thead class="bg-primary text-white text-center">
                        <tr>
                            <th scope="col" class="align-middle text-nowrap">CANTIDAD</th>
                            <th scope="col" class="align-middle">REPUESTO</th>
                            <th scope="col" class="align-middle">COSTO UNITARIO</th>
                            <th scope="col" class="align-middle">COSTO TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $d)
                            <tr>
                                <td>{{$d['Cantidad']}}</td>
                                <td>{{$d['Repuesto']}}</td>
                                <td>{{$d['Costo Unitario']}}</td>
                                <td>{{$d['Costo Total']}}</td>
                            </tr>
                            @endforeach

                    </table>

                </div>
            <div class="modal-footer">
                <p class="text-justify">Q. {{number_format($total,2) }}</p>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
