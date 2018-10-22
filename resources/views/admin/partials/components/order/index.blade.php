@php($title = $title ?? 'title')
@php($childrenKey = $childrenKey ?? null)
<div class="order">
    @include('admin.partials.components.order.list', ['level' => 1,'items' => $items, 'title' => $title, 'childrenKey' => $childrenKey])
</div>