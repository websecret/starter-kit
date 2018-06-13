@component('admin.partials.form.components.wrapper', ['name' => $name, 'labelName' => $labelName, 'wrapped' => $wrapped])
    @php($attributes = $attributes ? $attributes : [])
    @php($attributes['class'] = trim(array_get($attributes, 'class') . ' form-control js-form__input js-input-password__field'))
    <div class="input-group js-input-password">
        {{ Form::password($name, $attributes) }}
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-secondary h-auto js-input-password__toggle">
                <i class="fe fe-eye js-input-password__toggle-icon" data-show-class="fe-eye" data-hide-class="fe-eye-off"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary h-auto js-input-password__generate">
                <i class="fe fe-refresh-cw"></i>
            </button>
        </div>
    </div>
@endcomponent