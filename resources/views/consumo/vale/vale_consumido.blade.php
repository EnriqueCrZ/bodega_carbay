<label for="vale">No. de Vale</label>
<select name="vale" class="form-control selector" id="vale_ingreso">
    @if(count($ingresos)>0)
        @foreach ($ingresos as $i)
            <option value="{{ $i->idingreso }}">{{ $i->vale }} - {{ returnRepuesto($i->repuesto_id) }}</option>
        @endforeach
    @else
        <option value="" disabled>No hay vales para consumir</option>
    @endif
</select>

@if(count($ingresos)>0)
<label for="cantidad">Cantidad</label>
<input class="form-control" type="number" name="cantidad" id="cantidad" min="1" max="{{ $ingresos[0]->cantidad }}">
@endif

<input type="hidden" name="tipoVale" value="consumido">

<script>
    $(".selector").select2({
                allowClear: true
            });
            $(function () {
       $( "#cantidad" ).change(function() {
          var max = parseInt($(this).attr('max'));
          var min = parseInt($(this).attr('min'));
          if ($(this).val() > max)
          {
              $(this).val(max);
          }
          else if ($(this).val() < min)
          {
              $(this).val(min);
          }
        });
    });
</script>
