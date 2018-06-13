@component('admin.partials.form.components.wrapper', ['name' => $name, 'labelName' => $labelName, 'wrapped' => $wrapped])
    @php($attributes = $attributes ? $attributes : [])
    @php($attributes['class'] = trim(array_get($attributes, 'class') . ' form-control js-form__input js-input-date'))
    @php($value = ($value instanceof Carbon\Carbon) ? $value->format('d.m.Y') : $value)
    {{ Form::text($name, $value, $attributes) }}
@endcomponent