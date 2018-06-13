@component('admin.partials.form.components.wrapper', ['name' => $name, 'labelName' => $labelName, 'wrapped' => $wrapped])
    @php($selectAttributes = $selectAttributes ? $selectAttributes : [])
    @php($selectAttributes['multiple'] = 'multiple')
    @php($selectAttributes['class'] = trim(array_get($selectAttributes, 'class') . ' form-control js-form__input js-input-selectize'))
    @php($optionsAttributes = $optionsAttributes ? $optionsAttributes : [])
    @php($optgroupsAttributes = $optgroupsAttributes ? $optgroupsAttributes : [])
    {{ Form::select($name, $list, $selected, $selectAttributes, $optionsAttributes, $optgroupsAttributes) }}
@endcomponent