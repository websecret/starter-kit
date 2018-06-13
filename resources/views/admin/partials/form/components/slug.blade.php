@component('admin.partials.form.components.wrapper', ['name' => $name, 'labelName' => $labelName, 'wrapped' => $wrapped])
    @php($attributes = $attributes ? $attributes : [])
    @php($attributes['class'] = trim(array_get($attributes, 'class') . ' form-control js-form__input js-input-slug__field'))
    @php($attributes['data-slug-from'] = json_encode($from ? $from : []))
    <div class="input-group js-input-slug">
        {{ Form::text($name, $value, $attributes) }}
        <div class="input-group-append">
            <button type="button" class="btn btn-{{ $locked ? 'dark' : 'outline-secondary' }}  h-auto js-input-slug__toggle" data-unlock-class="btn-dark" data-lock-class="btn-outline-secondary">
                <i class="fe fe-{{ $locked ? 'unlock' : 'lock' }} js-input-slug__toggle-icon" data-unlock-class="fe-unlock" data-lock-class="fe-lock"></i>
            </button>
        </div>
    </div>
@endcomponent