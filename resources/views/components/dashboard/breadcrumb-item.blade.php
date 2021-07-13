<li class="breadcrumb-item @if(Route::current()->getName() == $route) active @endif">
    @if (Route::current()->getName() != $route)<a href="{{ route($route, $routeParam) }}">{{ $title }}</a>
    @else {{ $title }}
    @endif
</li>
