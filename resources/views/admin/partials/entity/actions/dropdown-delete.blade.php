@php($link = $link ?? route($routeName . '.delete', $model))

<a href="{{ $link }}" class="ml-2 js-confirm-delete" data-toggle="tooltip" title="{{ __('theme.delete_button') }}">
    <i class="fe fe-trash text-danger"></i>
</a>