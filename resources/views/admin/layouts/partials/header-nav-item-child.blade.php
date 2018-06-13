@php
    $url = route($item['route'], $item['routeParams']);
    $isActive = $item['exact'] ? ($url == request()->url()) : (starts_with(request()->url(), $url));
@endphp
<a href="{{ $url }}" class="dropdown-item {{ $isActive ? 'active' : '' }}">
    {{ $item['text'] }}
</a>