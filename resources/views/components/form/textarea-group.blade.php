<div class="form-group {{ $width }}">
    <label for="input_{{ $name }}">{{ $label }}</label>
    <textarea {{ $attributes->merge([
        'id' => "input_$name",
        'name' => $name,
        'class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')
    ]) }}>{{ $value }}</textarea>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
