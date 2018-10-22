@php
    $url = isset($item['route']) ? route($item['route'], $item['routeParams']) : null;
    $isActive = $url ? ($item['exact'] ? ($url == request()->url()) : (starts_with(request()->url(), $url))) : false;
    $children = array_get($item, 'children', []);
    $isChildrenActive = false;
    $badgeClass = $item['badge'] ?? false;
    foreach($children as $child) {
        $childUrl = route($child['route'], $child['routeParams'] ?? []);
        $isChildrenActive = $child['exact'] ?? false ? ($childUrl == request()->url()) : (starts_with(request()->url(), $childUrl));
        if($isChildrenActive) break;
    }
@endphp
<li class="nav-item {{ count($children) ? 'dropdown' : '' }}">
    <a href="{{ $url ? $url : '#' }}"
       class="nav-link {{ $isActive || $isChildrenActive ? 'active' : '' }}" {{ count($children) ? 'data-toggle=dropdown' : '' }}>
        @if($item['icon'])
            <i class="{{ $item['icon'] }}"></i>
        @endif
        {!! $item['text'] !!}
        @if($badgeClass && !count($children))
            <span class="badge js_new__{{ $badgeClass }}-count" data-type="" data-cloned="0"></span>
        @endif
    </a>
    @include('admin.layouts.partials.header-nav-item-children', [
        'children' => array_merge($url ? [$item] : [], $children),
    ])
</li>