<ul class="list-unstyled order__list {{ $level == 1 ? 'js-sortable' : '' }}" data-sortable-link="{{ route($routeName . '.order') }}">
    @foreach($items as $item)
        <li class="order__item js-sortable__item" data-id="{{ $item->id }}">
            <div class="order__item-content">
                <a href="#" class="order__item-content__icon js-sortable__handle">
                    <i class="fe fe-align-justify"></i>
                </a>
                <div>
                    {{ data_get($item, $title) }}
                </div>
            </div>
            @if($childrenKey && count($item[$childrenKey]))
                @include('admin.partials.components.order.list', ['level' => $level + 1, 'items' => $item[$childrenKey]])
            @endif
        </li>
    @endforeach
</ul>