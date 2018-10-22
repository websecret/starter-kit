@php($field = $field ?? 'created_at')
@php($showHuman = $showHuman ?? false)

@if($model->{$field})
    <div class="small text-muted">{{ $model->{$field}->format('d.m.Y H:i') }}</div>
    @if($showHuman)
        <div>{{ Date::instance($model->{$field})->diffForHumans() }}</div>
    @endif
@endif