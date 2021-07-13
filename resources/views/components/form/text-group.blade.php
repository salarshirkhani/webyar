<div class="form-group {{ $width }}">
    <label for="input_{{ $name }}">{{ $label }}</label>
    <input {{ $attributes->merge([
        'id' => "input_$name",
        'type' => 'text',
        'name' => $name,
        'value' => $value,
        'class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')
    ]) }}>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
