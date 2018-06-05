@extends('admin.partials.entity.index', ['section' => 'pages', 'items' => $pages])

@section('table')
    <div class="table-responsive">
        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
            <thead>
            <tr>
                <th class="text-center w-1">#</th>
                <th>{{ __("labels.title") }}</th>
                <th class="text-center">{{ __("labels.is_disabled") }}</th>
                <th>{{ __("labels.created_at") }}</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($pages as $page)
                <tr class="js-fast__wrapper" data-fast-link="{{ route('admin.pages.fast', $page) }}">
                    <td class="text-center">
                        <div class="small text-muted">{{ $page->id }}</div>
                    </td>
                    <td>
                        <div>
                            <a href="{{ route('admin.pages.edit', $page) }}">
                                {{ $page->custom_attributes->title }}
                            </a>
                        </div>
                        <div class="small text-muted">
                            {{ $page->slug }}
                        </div>
                    </td>
                    <td class="text-center">
                        @include('admin.partials.entity.actions.fast', [
                            'name' => 'is_disabled',
                            'value' => $page->is_disabled,
                        ])
                    </td>
                    <td>
                        <div class="small text-muted">{{ $page->created_at->format('d.m.Y H:i') }}</div>
                        <div>{{ Date::instance($page->created_at)->diffForHumans() }}</div>
                    </td>
                    <td class="text-center">
                        <div class="item-action text-right">
                            @include('admin.partials.entity.actions.dropdown-edit', [
                                'link' => route('admin.pages.edit', $page)
                            ])
                            @include('admin.partials.entity.actions.dropdown-delete', [
                                'link' => route('admin.pages.delete', $page)
                            ])
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @if(!$pages->lastPage())
        <div class="card-footer">
            <nav>
                {{ $pages->links() }}
            </nav>
        </div>
    @endif
@endsection