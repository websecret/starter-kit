@php($locales = LaravelLocalization::getSupportedLocales())
@php($currentLocale = LaravelLocalization::getCurrentLocale())

@component('admin.partials.form.components.wrapper', ['name' => $name, 'labelName' => $labelName, 'wrapped' => $wrapped])
    @php($options = $options ? $options : [])
    @php($options['class'] = trim(array_get($options, 'class') . ' form-control js-form__input js-translatable__input-field js-input-wysiwyg'))
    @php($options['data-name'] = $name)
    <div class="js-translatable__wrapper">
        @foreach($locales as $locale => $localeData)
            <div class="js-translatable__input-wrapper" data-locale="{{ $locale }}" style="{{ $locale == $currentLocale ? '' : 'display: none;' }}">
                {{ Form::textarea($name . '[' . $locale . ']', array_get($value->getValue(), $locale), $options) }}
            </div>
        @endforeach
        @include('admin.partials.form.components.translatable-toggle', ['locales' => $locales, 'currentLocale' => $currentLocale])
    </div>
@endcomponent