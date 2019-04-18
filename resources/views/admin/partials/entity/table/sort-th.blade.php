<?php
    $title = $title ?? '';
    $classes = $classes ?? [];
    $orderBy = $orderBy ?? false;
    $currentColumn = request()->input('sort_by', $defaultSortBy);
    $orderDirection = request()->input('sort_direction', $defaultSortDirection);
    $revertedDirection = $orderDirection === 'desc' && $currentColumn === $orderBy ? 'asc' : 'desc';
    $parameters = ['sort_by' => $orderBy, 'sort_direction' => $revertedDirection];
    $parameters['filter'] = request()->input('filter');
?>

<th class="{{ implode(' ', $classes) }}">
    <div>
        @if($orderBy)
            <a href="{{ route($routeName.'.index', $parameters) }}">
                {{ $title }}
            </a>
            @if($orderBy === $currentColumn)
            @if($orderDirection === 'desc')
                <i class="fe fe-arrow-down"></i>
            @else
                <i class="fe fe-arrow-up"></i>
            @endif
        @endif
        @else
            {{ $title }}
        @endif
    </div>
</th>