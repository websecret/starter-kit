@extends('admin.layouts.main')

@push('title', __('sections.' . $section . '.title'))

@section('content')
    <div class="row row-cards row-deck">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between d-flex flex-grow-1">
                        <div class="col">
                            <h3 class="card-title">{{ __('sections.' . $section . '.title') }}</h3>
                        </div>
                        <div class="col text-right">
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.' . $route .'.index') }}">
                                <i class="fe fe-chevron-left"></i>
                                {{ __('sections.' . $section . '.title') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if($items->count())
                    @yield('order')
                @else
                    <div class="card-footer">
                        <div class="text-muted">{{ __('sections.' . $section .  '.not_found') }}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection