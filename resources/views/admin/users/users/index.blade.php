@php($models = $users)

@extends('admin.partials.entity.index')

@section('table')
    <div class="table-responsive">
        <table class="table table-hover table-outline table-vcenter text-nowrap card-table">
            <thead>
            <tr>
                @include('admin.partials.entity.table.sort-th', ['orderBy' => 'id', 'title' => '#', 'classes' => ['text-center', 'w-1']])
                <th>{{ __("labels.full_name") }}</th>
                <th>{{ __("labels.email") }}</th>
                <th>{{ __("labels.role") }}</th>
                <th>{{ __("labels.register_at") }}</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($models as $model)
                <tr>
                    <td class="text-center">
                        @include('admin.partials.entity.table.id')
                    </td>
                    <td>
                        @include('admin.partials.entity.table.title', ['title' => $model->full_name])
                    </td>
                    <td>{{ $model->email }}</td>
                    <td>{{ optional($model->role)->title }}</td>
                    <td>
                        @include('admin.partials.entity.table.date')
                    </td>
                    <td class="text-center">
                        <div class="item-action text-right">
                            @include('admin.partials.entity.actions.dropdown-edit')
                            @include('admin.partials.entity.actions.dropdown-delete')
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('admin.partials.entity.partials.paginator')
@endsection