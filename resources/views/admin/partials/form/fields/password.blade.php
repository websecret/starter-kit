@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif
@if($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif
@if($showField)
    <div class="input-group js-input-password">
        {!! Form::input('password', $name, $options['value'], $options['attr']) !!}
        <div class="input-group-append">
            <button type="button" class="btn btn-outline-secondary h-auto js-input-password__toggle">
                <i class="fe fe-eye js-input-password__toggle-icon" data-show-class="fe-eye" data-hide-class="fe-eye-off"></i>
            </button>
            <button type="button" class="btn btn-outline-secondary h-auto js-input-password__generate">
                <i class="fe fe-refresh-cw"></i>
            </button>
        </div>
    </div>
    @include('vendor.laravel-form-builder.help_block')
@endif
@include('vendor.laravel-form-builder.errors')
@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        </div>
    @endif
@endif