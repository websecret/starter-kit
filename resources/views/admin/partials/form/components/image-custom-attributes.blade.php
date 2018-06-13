
<div class="js-image__custom-attributes">
    @foreach($customAttributes as $customAttributeName => $customAttributeClass)
        @php($customAttributeClassName = 'adminTranslatable' . studly_case($customAttributeClass) . 'Unwrapped')
        @php($dataNameBefore = $name . '[' . $type. '][values]')
        @php($dataNameAfter = '[custom_attributes][' . $customAttributeName . ']')
        @php($dataName = $dataNameBefore . '[' . $key . ']' . $dataNameAfter)
        @php($attributes = ['data-name-before' => $dataNameBefore, 'data-name-after' => $dataNameAfter])
        @if(!$image)
            @php($attributes['disabled'] = 'disabled')
        @endif
        {{ Form::{$customAttributeClassName}($dataName, $image ? $image->custom_attributes->{$customAttributeName} : null, $attributes) }}
    @endforeach
</div>