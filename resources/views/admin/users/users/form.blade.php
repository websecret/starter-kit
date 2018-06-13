@extends('admin.layouts.main')

@push('title', __('sections.users.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            {!! Form::model($user, ['route' => ['admin.users.users.store', $user], 'class' => 'card js-form js-form--slug js-form--back']) !!}
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('sections.users.' . ($user->exists ? 'edit' : 'add')) }}
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        {{ Form::adminText('last_name') }}
                    </div>
                    <div class="col">
                        {{ Form::adminText('first_name') }}
                    </div>
                    <div class="col">
                        {{ Form::adminText('middle_name') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ Form::adminEmail('email') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ Form::adminSelect('role', \App\Services\SelectService::roles(), $user->role->id ?? null) }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ Form::adminPassword('password') }}
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                @include('admin.partials.entity.form.back')
                @include('admin.partials.entity.form.submit')
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection