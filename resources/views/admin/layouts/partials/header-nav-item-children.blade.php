@if(count($children))
    <div class="dropdown-menu dropdown-menu-arrow">
        @foreach($children as $child)
            @include('admin.layouts.partials.header-nav-item-child', [
                'item' => $child,
            ])
        @endforeach
    </div>
@endif