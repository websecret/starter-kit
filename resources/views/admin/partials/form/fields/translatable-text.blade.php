@if($showLabel && $showField)
    @if($options['wrapper'] !== false)
        <div {!! $options['wrapperAttrs'] !!}>
            @endif
            @endif
            @if($showLabel && $options['label'] !== false && $options['label_show'])
                {!! Form::customLabel($name, $options['label'], $options['label_attr']) !!}
            @endif
            @if($showField)
                <div class="js-translatable__wrapper">
                    @foreach($options['locales'] as $locale => $localeData)
                        <div class="js-translatable__input-wrapper" data-locale="{{ $locale }}" style="{{ $locale == $options['locale'] ? '' : 'display: none;' }}">
                            {!! Form::text($name . '[' . $locale . ']', $options['value']->getValue()[$locale], array_except($options['attr'], ['required'])) !!}
                            @include('vendor.laravel-form-builder.errors')
                        </div>
                    @endforeach
                    <div class="mb-1">
                        @foreach($options['locales'] as $locale => $localeData)
                            <a href="#" class="badge {{ $locale == $options['locale'] ? 'badge-dark' : 'badge-default' }}  js-translatable__link" data-locale="{{ $locale }}">
                                {{ $locale }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @include('vendor.laravel-form-builder.help_block')
            @endif
            @if($showLabel && $showField)
                @if($options['wrapper'] !== false)
        </div>
    @endif
@endif