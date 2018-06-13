@component('admin.partials.form.components.wrapper', ['name' => $name, 'labelName' => $labelName, 'wrapped' => $wrapped])
    @php($options = $options ? $options : [])
    @php($options['class'] = trim(array_get($options, 'class') . ' form-control js-form__input'))
    {{ Form::textarea($name, $value, $options) }}
@endcomponent