<label for="vale">No. de Vale</label>
<select name="vale" class="form-control selector" id="vale">
    @if(count($ingresosValeSinConsumir)>0)
        @foreach ($ingresosValeSinConsumir as $ingreso)
            <option value="{{ $ingreso->vale }}">{{ $ingreso->vale }}</option>
        @endforeach
    @else
        <option value="" disabled>No hay vales completos sin consumir</option>
    @endif
</select>

<input type="hidden" name="tipoVale" value="sinConsumir">
