<li class="nav-item">
    @if(!empty($route))
        <a href="{{ route($route, $routeParam) }}" class="nav-link @if(Route::current()->getName() == $route) active @endif">
    @else
        <span class="nav-link">
    @endif
        <i class="nav-icon {{ $icon }}"></i>
        <p>
            {{ $title }}
        </p>
    @if(!empty($route))
        </a>
    @else
        </span>
    @endif
</li>
