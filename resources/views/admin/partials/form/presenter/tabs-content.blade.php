<div class="tab-content">
    @php($key = 0)
    @foreach($tabs as $tab)
        <div class="tab-pane fade {{ ($key == 0) ? 'show active' : '' }}" id="{{ $tab->getSlug() }}">
            {!! $tab->renderRows() !!}
        </div>
        @php($key++)
    @endforeach
</div>