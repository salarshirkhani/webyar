<option {{ $attributes->merge([
    'value' => $value
]) }}>
    {{ $slot }}
</option>
