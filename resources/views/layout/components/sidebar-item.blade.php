<li class="nav-item{{ is_current_path($route) ? ' active' : '' }}">
    <a href="{{ route($route) }}" class="nav-link">
        <i class="material-icons">{{ $icon }}</i>
        <p>{{ $text }}</p>
    </a>
</li>
