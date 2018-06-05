<ul class="nav nav-tabs mb-4" role="tablist">
    @php($key = 0)
    @foreach($tabs as $tab)
        <li class="nav-item">
            <a class="nav-link {{ ($key == 0 ? 'active' : '') }}" data-toggle="tab" href="#{{ $tab->getSlug() }}" role="tab">
                {{ $tab->getName() }}
            </a>
        </li>
        @php($key++)
    @endforeach
</ul>