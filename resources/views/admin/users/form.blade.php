@extends('admin.layouts.main')

@section('content')
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.users.store', $user) }}" method="post" class="card">
                {{ csrf_field() }}
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('sections.users.' . ($user->exists ? 'edit' : 'add')) }}
                    </h3>
                </div>
                <div class="card-body">
                    {!! form_rest($form) !!}
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fe fe-save"></i>
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection