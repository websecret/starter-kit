@extends('admin.root')

@section('layout')
    <div class="page-main">
        @include('admin.layouts.partials.header')
        @include('admin.layouts.partials.header-nav')
        <div class="my-3 my-md-5">
            <div class="container">
                @if(isset($breadcrumbs) ? $breadcrumbs : true)
                    @include('admin.layouts.partials.breadcrumbs')
                @endif
            </div>
            <div class="container">
                @include('admin.layouts.partials.alerts.success')
                @yield('content')
            </div>
        </div>
    </div>
    @include('admin.layouts.partials.footer')
@endsection