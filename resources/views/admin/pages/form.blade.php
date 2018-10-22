@extends('admin.layouts.main')

@push('title', __('sections.pages.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            {!! Form::model($page, ['route' => ['admin.pages.store', $page], 'class' => 'card js-form js-form--slug js-form--back']) !!}
            <div class="card-header">
                <h3 class="card-title">
                    {{ __('sections.pages.' . ($page->exists ? 'edit' : 'add')) }}
                </h3>
            </div>
            <div class="card-body">
                <div class="mb-5">
                    @component('admin.partials.components.tabs')
                        @slot('header', ['Основное', 'Meta'])
                        @slot('tab0')
                            <div class="row">
                                <div class="col">
                                    {{ Form::adminBoolean('is_disabled', (int) $page->is_disabled) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    {{ Form::adminTranslatableText('custom_attributes[title]', $page->custom_attributes->title, [], __('labels.title')) }}
                                </div>
                                <div class="col">
                                    {{ Form::adminSlug('slug', $page->slug, ['custom_attributes[title]'], $page->exists) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    {{ Form::adminTranslatableWysiwyg('custom_attributes[content]', $page->custom_attributes->content, [], __('labels.content')) }}
                                </div>
                            </div>
                        @endslot
                        @slot('tab1')
                            <div class="row">
                                <div class="col-8">
                                    {{ Form::adminTranslatableText('custom_attributes[meta_title]', $page->custom_attributes->meta_title, [], __('labels.meta_title')) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    {{ Form::adminTranslatableTextarea('custom_attributes[meta_description]', $page->custom_attributes->meta_description, [], __('labels.meta_description')) }}
                                </div>
                            </div>
                        @endslot
                    @endcomponent
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