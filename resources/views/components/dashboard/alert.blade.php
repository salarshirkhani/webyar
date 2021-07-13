<div {{ $attributes->merge(['class' => "alert" . (empty($type) ? '' : " alert-$type")]) }}>
    {{ $slot }}
</div>
