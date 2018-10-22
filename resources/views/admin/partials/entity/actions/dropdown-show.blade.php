@php($link = $link ?? route($routeName . '.show', $model))

<a href="{{ $link }}" class="ml-2" data-toggle="tooltip" title="{{ __('theme.show_button') }}">
    <i class="fe fe-eye"></i>
</a>