<?php
$slot = preg_replace("/<option(.*?) value=\"$value\"(.*?)>/", "<option $1 value=\"$value\" selected $2>", $slot);
?>
<div class="form-group {{ $width }}">
    <label for="input_{{ $name }}">{{ $label }}</label>
    <select {{ $attributes->merge([
        'id' => "input_$name",
        'name' => $name,
        'class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')
    ]) }}>
        {!! $slot !!}
    </select>
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
</div>
