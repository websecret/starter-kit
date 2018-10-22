@php
    $routeParams = $item['routeParams'] ?? [];
    $url = route($item['route'], $routeParams);
    $exact = $exact ?? false;
    $badgeClass = $item['badge'] ?? false;
    $isActive = $exact ? ($url == request()->url()) : (starts_with(request()->url(), $url));
@endphp
<a href="{{ $url }}" class="dropdown-item {{ $isActive ? 'active' : '' }}">
    {{ $item['text'] }}
    @if($badgeClass)
        <span class="badge js_new__{{ $badgeClass }}-count" data-type="" data-cloned="0"></span>
    @endif
</a>