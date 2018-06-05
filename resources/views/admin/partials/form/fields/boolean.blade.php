@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif
@if($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif
@if($showField)
    <div class="custom-controls-stacked">
        <label class="custom-control custom-radio custom-control-inline">
            {!! Form::radio($name, 1, $options['value'] ? true : false, $options['attr']) !!}
            <span class="custom-control-label">Да</span>
        </label>
        <label class="custom-control custom-radio custom-control-inline">
            {!! Form::radio($name, 0, $options['value'] ? false : true, $options['attr']) !!}
            <span class="custom-control-label">Нет</span>
        </label>
    </div>
    @include('vendor.laravel-form-builder.help_block')
@endif
@include('vendor.laravel-form-builder.errors')
@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        </div>
    @endif
@endif