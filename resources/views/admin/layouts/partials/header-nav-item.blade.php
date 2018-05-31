@php
$url = route($item['route'], $item['routeParams']);
$isActive = $item['exact'] ? ($url == request()->url()) : (starts_with(request()->url(), $url));
@endphp
<li class="nav-item">
    <a href="{{ $url }}" class="pjax nav-link {{ $isActive ? 'active' : '' }}">
        @if($item['icon'])
            <i class="{{ $item['icon'] }}"></i>
        @endif
        {!! $item['text'] !!}
    </a>
</li>