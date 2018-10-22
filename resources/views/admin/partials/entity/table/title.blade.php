@php($title = $title ?? $model->{$model->getTitle() ?? 'title'})

<div style="max-width: 360px; overflow: hidden; text-overflow: ellipsis;">
    @php($routeName = 'admin.' . (new \App\Services\Model\Admin($model))->getRouteName())
    <a href="{{ route($routeName . '.edit', $model) }}">
        {{ $title }}
    </a>
</div>
@if($model->url)
    <div class="small " style="max-width: 360px; overflow: hidden; text-overflow: ellipsis;">
        <a class="text-muted" href="{{ $model->url }}/{{ $model->slug }}" target="_blank">
            {{ $model->slug }}
        </a>
    </div>
@endif