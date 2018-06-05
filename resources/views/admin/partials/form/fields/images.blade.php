@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
    @endif
@endif
@if($showLabel && $options['label'] !== false && $options['label_show'])
    {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
@endif

@if($showField)
    <input name="{{ $name }}[present]" value="1" type="hidden">
    <div class="row gutters-sm js-images__wrapper" data-images-type="{{ $options['images']['type'] }}" data-images-is-multiple="{{ $options['images']['isMultiple'] }}">
        <div class="col-12 mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input js-images__input">
                <label class="custom-file-label">Выберите изображение</label>
            </div>
        </div>
        @php($key = 0)
        @foreach($options['values'] as $image)
            <div class="col-2 col-sm-2 js-image">
                <label class="imagecheck mb-4 js-image__label">
                    <input class="imagecheck-input js-image__is-main" name="{{ $name }}[main_index]" value="{{ $key }}" {{ $image->is_main ? 'checked' : '' }} type="radio">
                    <figure class="imagecheck-figure">
                        <img class="imagecheck-image js-image__img" src="{{ $image->getUrl('admin-form') }}" alt="">
                    </figure>
                    <input class="js-image__path" type="hidden" name="{{ $name }}[old][]" value="{{ $image->path }}">
                    <a href="#" class="imagecheck-remove js-image__remove"><span class="fe fe-x"></span></a>
                </label>
            </div>
            @php($key++)
        @endforeach
        <div class="col-2 col-sm-2 js-image js-image--clone">
            <label class="imagecheck mb-4 js-image__label">
                <input class="imagecheck-input js-image__is-main" name="{{ $name }}[main_index]" value="{{ $key }}" type="radio" disabled>
                <figure class="imagecheck-figure">
                    <img class="imagecheck-image js-image__img" src="" alt="">
                </figure>
                <input class="js-image__path" type="hidden" name="{{ $name }}[new][]" value="" disabled>
                <a href="#" class="imagecheck-remove js-image__remove"><span class="fe fe-x"></span></a>
            </label>
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