@php($model = $user)
@extends('admin.partials.entity.form')

@section('form')
    @php(Form::setModel($model))
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
            {{ Form::adminSelect('role', \App\Services\SelectService::roles(), $model->role->id ?? null) }}
            {{ Form::adminPassword('password') }}
        </div>
    </div>
@endsection