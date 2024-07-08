<li class="nav-item">
    <a href="{{ url($url) }}" class="nav-link @if ($active) active @endif">
      <i class="nav-icon fas fa-{{ $icon }}"></i>
      <p>
        {{ $title }}
      </p>
    </a>
  </li>