@php($models = $pages)

@extends('admin.partials.entity.index')

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
            @foreach($models as $model)
                <tr class="js-fast__wrapper" data-fast-link="{{ route($routeName . '.fast', $model) }}">
                    <td class="text-center">
                        @include('admin.partials.entity.table.id')
                    </td>
                    <td>
                        @include('admin.partials.entity.table.title', ['title' => $model->custom_attributes->title])
                    </td>
                    <td class="text-center">
                        @include('admin.partials.entity.actions.fast')
                    </td>
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