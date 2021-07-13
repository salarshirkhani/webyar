<div class="form-group {{ $width }}">
    <div class="custom-file">
        <input {{ $attributes->merge([
            'id' => "input_$name",
            'name' => $name,
            'type' => 'file',
            'class' => 'form-control custom-file-input' . ($errors->has($name) ? ' is-invalid' : '')
        ]) }}>
        <label class="custom-file-label" for="input_{{ $name }}">{{ $label }}</label>
        @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
