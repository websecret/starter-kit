@if($wrapped)
    <div class="form-group js-form__wrapper">
        {{ Form::label($name, $labelName ? $labelName : __('labels.' . $name), ['class' => 'form-label js-form__input-label']) }}
        {{ $slot }}
        @include('admin.partials.form.components.errors', [
            'name' => $name,
        ])
    </div>
@else
    {{ $slot }}
    @include('admin.partials.form.components.errors', [
        'name' => $name,
    ])
@endif