@extends('admin.partials.entity.order', ['section' => 'pages', 'route' => 'pages', 'items' => $pages])


@section('order')
    @include('admin.partials.components.order.index', ['route' => 'pages', 'items' => $pages, 'title' => 'custom_attributes.title', 'childrenKey' => null])
@endsection