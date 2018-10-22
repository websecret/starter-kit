<a href="{{ route($routeName . '.index', request()->except('filter')) }}" class="btn btn-outline-primary">
    {{ __('theme.reset_filter_button') }}
</a>