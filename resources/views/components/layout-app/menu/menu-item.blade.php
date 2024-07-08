<li class="nav-item">
    <a href="{{ url($url) }}" class="nav-link @if($active) active @endif">
        <i class="nav-icon far fa-{{ $icon }}" aria-hidden="true"></i>
        <p>{{ $title }}</p>
    </a>
</li>