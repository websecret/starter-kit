@php($link = $link ?? route($routeName . '.edit', $model))
@php($popup = $popup ?? false)

@if($popup)
    <a href="#" class="ml-2" data-url="{{ $link }}" data-toggle="modal" data-target="#modal">
        <i class="fe fe-edit-2"></i>
    </a>
@else
    <a href="{{ $link }}" class="ml-2" data-toggle="tooltip" title="{{ __('theme.edit_button') }}">
        <i class="fe fe-edit-2"></i>
    </a>
@endif