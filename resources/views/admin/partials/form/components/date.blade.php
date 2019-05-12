@component('admin.partials.form.components.wrapper', ['name' => $name, 'labelName' => $labelName, 'wrapped' => $wrapped])
    @php($attributes = $attributes ? $attributes : [])
    @php($id = array_get($attributes, 'id', 'datetimepicker-' . str_random()))
    @php($attributes['data-target'] = '#' . $id)
    @php($attributes['data-toggle'] = array_get($attributes, 'data-toggle', 'datetimepicker'))
    @php($attributes['data-date-time-format'] = array_get($attributes, 'data-date-time-format', 'DD.MM.YYYY'))
    @php($attributes['data-date-time-carbon-format'] = array_get($attributes, 'data-date-time-carbon-format', 'd.m.Y'))
    @php($attributes['class'] = trim(array_get($attributes, 'class') . ' form-control js-form__input datetimepicker-input'))
    <div class="input-group date js-input-datetime" id="{{ $id }}" data-target-input="nearest">
        {{ Form::carbonDate($name, $value, $attributes) }}
        <div class="input-group-append" data-target="{{ $attributes['data-target'] }}" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fe fe-calendar"></i></div>
        </div>
    </div>
@endcomponent