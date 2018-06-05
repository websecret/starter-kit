@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif
@if($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif
@if($showField)
    <div class="input-group js-input-slug">
        {!! Form::input('text', $name, $options['value'], $options['attr']) !!}
        <div class="input-group-append">
            <button type="button" class="btn btn-{{ $options['locked'] ? 'dark' : 'outline-secondary' }}  h-auto js-input-slug__toggle" data-unlock-class="btn-dark" data-lock-class="btn-outline-secondary">
                <i class="fe fe-{{ $options['locked'] ? 'unlock' : 'lock' }} js-input-slug__toggle-icon" data-unlock-class="fe-unlock" data-lock-class="fe-lock"></i>
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