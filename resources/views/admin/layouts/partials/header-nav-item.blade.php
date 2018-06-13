@php
$url = route($item['route'], $item['routeParams']);
$isActive = $item['exact'] ? ($url == request()->url()) : (starts_with(request()->url(), $url));
$children = array_get($item, 'children', []);
$isChildrenActive = false;
foreach($children as $child) {
    $childUrl = route($child['route'], $child['routeParams']);
    $isChildrenActive = $child['exact'] ? ($childUrl == request()->url()) : (starts_with(request()->url(), $childUrl));
    if($isChildrenActive) break;
}
@endphp
<li class="nav-item {{ count($children) ? 'dropdown' : '' }}">
    <a href="{{ $url }}" class="nav-link {{ $isActive || $isChildrenActive ? 'active' : '' }}" {{ count($children) ? 'data-toggle=dropdown' : '' }}>
        @if($item['icon'])
            <i class="{{ $item['icon'] }}"></i>
        @endif
        {!! $item['text'] !!}
    </a>
    @include('admin.layouts.partials.header-nav-item-children', [
        'children' => array_merge([$item], $children),
    ])
</li>