@php
$tabs = [];
foreach($header as $key => $tab) {
    $tabs[] = [
        'key' => $key,
        'title' => $tab,
        'slug' => str_slug($tab) . '-' . str_random(),
    ];
}
@endphp
<ul class="nav nav-tabs mb-4" role="tablist">
    @foreach($tabs as $key => $tab)
        <li class="nav-item">
            <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="tab" href="#{{ $tab['slug'] }}" role="tab">
                {{ $tab['title'] }}
            </a>
        </li>
    @endforeach
</ul>
<div class="tab-content">
    @foreach($tabs as $key => $tab)
        @php($tabVar = 'tab' . $key)
        <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="{{ $tab['slug'] }}" role="tabpanel">
            {{ $$tabVar }}
        </div>
    @endforeach
</div>