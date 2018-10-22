@extends('admin.layouts.main')

@push('title', __($sectionPath . '.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            {!! Form::open(['route' => [$routeName . '.store', $model], 'class' => 'card js-form js-form--slug js-form--back']) !!}
            <div class="card-header">
                <h3 class="card-title">
                    {{ __($sectionPath . '.' . ($model->exists ? 'edit' : 'add')) }}
                    @yield('title')
                </h3>
            </div>
            <div class="card-body">
                @yield('form')
            </div>
            <div class="card-footer text-right">
                @include('admin.partials.entity.form.back')
                @include('admin.partials.entity.form.submit')
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection