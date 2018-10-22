@php
$tabs = [];
$tabsPrefix = $tabsPrefix ?? null;
foreach($header as $key => $tab) {
    $tabs[] = [
        'key' => $key,
        'title' => $tab,
        'slug' => str_slug(($tabsPrefix ? ($tabsPrefix . '-') : '') . $tab),
    ];
}
@endphp

@if(!request('tab'))
    @php($active = head($tabs)['slug'])
@else
    @php($active = request('tab'))
@endif

<ul class="nav nav-tabs mb-4" role="tablist" style="margin: 0">
    @foreach($tabs as $key => $tab)
        <li class="nav-item">
            <a class="nav-link {{ $active == $tab['slug'] ? 'active' : '' }}" data-toggle="tab" data-url="{{ request()->fullUrlWithQuery(['tab' => $tab['slug']]) }}" href="#{{ $tab['slug'] }}" role="tab">
                {{ $tab['title'] }}
            </a>
        </li>
    @endforeach
</ul>
<div class="tab-content">
    @foreach($tabs as $key => $tab)
        @php($tabVar = 'tab' . $key)
        <div class="tab-pane fade {{ $active == $tab['slug'] ? 'show active' : '' }}" id="{{ $tab['slug'] }}" role="tabpanel">
            @if($tab['title'] == 'SEO')
                @include('admin.partials.entity.tabs.meta')
            @elseif($tab['title'] == 'Видео')
                @include('admin.partials.entity.tabs.video')
            @else
                {{ $$tabVar ?? '' }}
            @endif
        </div>
    @endforeach
</div>