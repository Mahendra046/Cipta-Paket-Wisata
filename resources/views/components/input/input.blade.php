<div class="mb-3">
    <label for="{{ $label ?? '' }}">{{ $label ?? ''  }}</label>
    <input id="{{ $label ?? ''}}" class="form-control" type="{{ $type ?? 'text'}}" name="{{ $name ?? ''}}" placeholder="{{ $plc ?? '' }}" value="@isset($value){{$value}}@else{{old('nama_paket_wisata')}}@endisset">
    @error($name)
        <p class="text-danger float-right text-sm">{{ $message }}</p>
    @enderror
</div>


