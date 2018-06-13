@component('admin.partials.form.components.wrapper', ['name' => $name, 'labelName' => $labelName, 'wrapped' => $wrapped])
    @php($type = is_null($type) ? 'main' : $type)
    @php($multiple = is_null($multiple) ? true : $multiple)
    @php($customAttributes = $customAttributes ? $customAttributes : [])
    <input name="{{ $name }}[{{ $type }}][present]" value="1" type="hidden">
    <div class="row gutters-sm js-images__wrapper" data-images-type="{{ $type }}" data-images-is-multiple="{{ $multiple }}">
        <div class="col-12 mb-3">
            <div class="custom-file">
                <input type="file" class="custom-file-input js-images__input">
                <label class="custom-file-label">Выберите изображение</label>
            </div>
        </div>
        @php($key = 0)
        @php($images = $value->where('type', $type))
        @php($images = $multiple ? $images : $images->take(1))
        @foreach($images as $image)
            <div class="col-2 col-sm-2 js-image">
                <label class="imagecheck mb-4 js-image__label">
                    <input class="imagecheck-input js-image__is-main" name="{{ $name }}[{{ $type }}][main_index]" value="{{ $key }}" {{ $image->is_main ? 'checked' : '' }} type="radio">
                    <figure class="imagecheck-figure">
                        <img class="imagecheck-image js-image__img" src="{{ $image->getUrl('admin-form') }}" alt="">
                    </figure>
                    <input class="js-image__path" type="hidden" data-name-before="{{ $name }}[{{ $type }}][values]" name="{{ $name }}[{{ $type }}][values][{{ $key }}][path]" data-name-after="[path]" value="{{ $image->path }}">
                    <input class="js-image__is-new" type="hidden" data-name-before="{{ $name }}[{{ $type }}][values]" name="{{ $name }}[{{ $type }}][values][{{ $key }}][is_new]" data-name-after="[is_new]" value="0">
                    <a href="#" class="imagecheck-remove js-image__remove"><span class="fe fe-x"></span></a>
                </label>
                @include('admin.partials.form.components.image-custom-attributes', ['name' => $name, 'type' => $type, 'customAttributes' => $customAttributes, 'key' => $key, 'image' => $image])
            </div>
            @php($key++)
        @endforeach
        <div class="col-2 col-sm-2 js-image js-image--clone">
            <label class="imagecheck mb-4 js-image__label">
                <input class="imagecheck-input js-image__is-main" name="{{ $name }}[{{ $type }}][main_index]" value="{{ $key }}" type="radio" disabled>
                <figure class="imagecheck-figure">
                    <img class="imagecheck-image js-image__img" src="" alt="">
                </figure>
                <input class="js-image__path" type="hidden" data-name-before="{{ $name }}[{{ $type }}][values]" name="{{ $name }}[{{ $type }}][values][{{ $key }}][path]" data-name-after="[path]" value="" disabled>
                <input class="js-image__is-new" type="hidden" data-name-before="{{ $name }}[{{ $type }}][values]" name="{{ $name }}[{{ $type }}][values][{{ $key }}][is_new]" data-name-after="[is_new]" value="1" disabled>
                <a href="#" class="imagecheck-remove js-image__remove"><span class="fe fe-x"></span></a>
            </label>
            @include('admin.partials.form.components.image-custom-attributes', ['name' => $name, 'type' => $type, 'customAttributes' => $customAttributes, 'key' => $key, 'image' => null])
        </div>
    </div>
@endcomponent