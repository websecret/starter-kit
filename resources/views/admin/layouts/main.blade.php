@extends('admin.root')

@section('layout')
    @php($fluid = isset($fluid) ? $fluid : config('admin.fluid'))
    <div class="page-main">
        @include('admin.layouts.partials.header', ['fluid' => $fluid])
        @include('admin.layouts.partials.header-nav', ['fluid' => $fluid])
        <div class="my-3 my-md-5">
            <div class="{{ $fluid ? 'container-fluid' : 'container' }}">
                @if(isset($breadcrumbs) ? $breadcrumbs : true)
                    @include('admin.layouts.partials.breadcrumbs')
                @endif
            </div>
            <div class="{{ $fluid ? 'container-fluid' : 'container' }}">
                @include('admin.layouts.partials.alerts.success')
                @yield('content')
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.footer', ['fluid' => $fluid])
@endsection