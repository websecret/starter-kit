@extends('admin.layouts.main')

@push('title', __('sections.pages.' . ($page->exists ? 'edit' : 'add')))

@section('content')
    <div class="row">
        <div class="col-12">
            {!! Form::open(['route' => ['admin.pages.store', $page], 'class' => 'card js-form js-form--slug js-form--back']) !!}
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('sections.pages.' . ($page->exists ? 'edit' : 'add')) }}
                    </h3>
                </div>
                <div class="card-body">
                    {!! form_presenter_rest($form, 'admin') !!}
                </div>
                <div class="card-footer text-right">
                    <a href="{{ url()->previous() }}" class="pjax js-back btn btn-default">
                        <i class="fe fe-chevron-left"></i>
                        {{ __('theme.back_button') }}
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fe fe-save"></i>
                        {{ __('theme.save_button') }}
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection