<div {{ $attributes->merge(["class" => "card" . (!empty($type) ? " card-$type" : "")]) }}>
    {{ $slot }}
</div>
