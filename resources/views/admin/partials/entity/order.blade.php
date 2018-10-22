@extends('admin.layouts.main')

@push('title', __($sectionPath . '.title'))

@section('content')
    @hasSection('filters')
        {!! Form::open(['route' => [$routeName . '.order'], 'method' => 'get', 'class' => 'card']) !!}
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
                <div class="card-header">
                    <div class="row justify-content-between d-flex flex-grow-1">
                        <div class="col">
                            <h3 class="card-title">{{ __($sectionPath . '.title') }}</h3>
                        </div>
                        <div class="col text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route($routeName .'.index') }}">
                                <i class="fe fe-chevron-left"></i>
                                {{ __($sectionPath . '.title') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if($items->count())
                    @yield('order')
                @else
                    <div class="card-footer">
                        <div class="text-muted">{{ __($sectionPath .  '.not_found') }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection