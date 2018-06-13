@component('admin.partials.form.components.wrapper', ['name' => $name, 'labelName' => $labelName, 'wrapped' => $wrapped])
    @php($options = $options ? $options : [])
    @php($options['class'] = trim(array_get($options, 'class') . ' js-form__input custom-control-input'))
    <div class="custom-controls-stacked">
        @foreach($list as $variantValue => $variantText)
            <label class="custom-control custom-radio custom-control-inline">
                {{ Form::radio($name, $variantValue, $variantValue === $value, $options) }}
                <span class="custom-control-label">{{ $variantText }}</span>
            </label>
        @endforeach
    </div>
@endcomponent