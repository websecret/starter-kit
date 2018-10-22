@foreach($model->imagesConfig() as $imageType => $imageSizes)
    <div class="mb-3">
        <h4>
            @php($imageSizeKey = 0)
            @php($multiple = false)
            @foreach($imageSizes as $imageSize => $imageSizeData)
                @if($imageSizeKey != 0)|@endif
                {{ array_get($imageSizeData, 'description') }}
                ({{ array_get($imageSizeData, 'width', '?') }}x{{ array_get($imageSizeData, 'height', '?') }})
                @php($imageSizeKey++)
                @php($multiple = $imageSizeData['multiple'] ?? false)
            @endforeach
        </h4>
        <div>
            {{ Form::adminImages('images', $model->images, $multiple, $imageType) }}
        </div>
    </div>
@endforeach