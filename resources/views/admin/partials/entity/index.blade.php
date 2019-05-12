@extends('admin.layouts.main')

@push('title', __($sectionPath . '.title'))

@php($items = $items ?? $models)

@section('content')
    @hasSection('filters')
        {!! Form::open(['route' => [$routeName . '.index'], 'method' => 'get', 'class' => 'card']) !!}
        <div class="card-body pb-1">
            @yield('filters')
        </div>
        <div class="card-footer text-right">
            @include('admin.partials.entity.form.reset-filter')
            @include('admin.partials.entity.form.filter')
        </div>
        {!! Form::close() !!}
    @endif
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-status bg-blue"></div>
                <div class="card-header">
                    <div class="row justify-content-between d-flex flex-grow-1">
                        <div class="col">
                            <h3 class="card-title">
                                @if($count)
                                    <div class="tag tag-primary tag-upper">{{ trans_choice($sectionPath.'.count', $items->total()) }}</div>
                                @else
                                    <div class="tag tag-primary tag-upper">{{ __($sectionPath . '.title') }}</div>
                                    {{--<div class="badge badge-info filter__icon js_filter__toggle">--}}
                                    {{--<i class="fe fe-filter"></i>--}}
                                    {{--</div>--}}
                                @endif
                                @yield('counts')
                            </h3>
                        </div>
                        <div class="col text-right">
                            @yield('actions')

                            @if($canOrder)
                                <a class="btn btn-sm btn-dark" href="{{ route($routeName .'.order') }}">
                                    <i class="fe fe-list"></i>
                                    @if(__($sectionPath . '.order_button') == $sectionPath . '.order_button')
                                        {{ __('theme.order') }}
                                    @else
                                        {{ __($sectionPath . '.order_button') }}
                                    @endif
                                </a>
                            @endif
                            @if($canAdd)
                                <a class="btn btn-sm btn-success" href="{{ route($routeName .'.add') }}">
                                    <i class="fe fe-plus"></i>
                                    {{ __($sectionPath . '.add_button') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @if($items->count())
                    @yield('table')
                @else
                    <div class="card-footer">
                        <div class="text-muted">{{ __('theme.not_found') }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection