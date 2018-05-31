@extends('admin.layouts.single')

@section('content')
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-6">
                @if(config('admin.logo'))
                    <img src="{{ asset(config('admin.logo')) }}" class="h-8" alt="{{ config('admin.title') }}">
                @else
                    {{ config('admin.title') }}
                @endif
            </div>
            {!! Form::open(['action' => 'Admin\Auth\LoginController@login', 'class' => 'card']) !!}
                <div class="card-body p-6">
                    <div class="card-title">Авторизация</div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Пароль', ['class' => 'form-label']) !!}
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Пароль']) !!}
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            {!! Form::checkbox('remember', 1, null, ['class' => 'custom-control-input']) !!}
                            <span class="custom-control-label">Запомнить</span>
                        </label>
                    </div>

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">Войти</button>
                    </div>
                    @if ($errors->count() > 0)
                        <div class="alert alert-danger mt-6">
                            @foreach($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    @endif
                </div>
            {!! Form::close() !!}
            <div class="text-center text-muted">
                @include('admin.layouts.partials.copyright')
            </div>
        </div>
    </div>
@endsection