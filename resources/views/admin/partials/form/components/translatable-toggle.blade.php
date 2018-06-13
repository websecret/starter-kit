<div class="mb-1">
    @foreach($locales as $locale => $localeData)
        <a href="#" class="badge {{ $locale == $currentLocale ? 'badge-dark' : 'badge-default' }}  js-translatable__link" data-locale="{{ $locale }}">
            {{ $locale }}
        </a>
    @endforeach
</div>