@foreach($fields as $field => $options)
    <div class="{{ $options['class'] }}">
        {!! form_rows($form, [$field]) !!}
    </div>
@endforeach