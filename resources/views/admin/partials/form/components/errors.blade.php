<div class="invalid-feedback js-form__input-error">
    @foreach ($errors->get($name) as $message)
        {{ $message }} <br>
    @endforeach
</div>