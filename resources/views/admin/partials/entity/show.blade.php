@extends('admin.layouts.main')

@push('title', __($sectionPath . '.title'))

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between d-flex flex-grow-1">
                        <div class="col">
                            <h3 class="card-title">
                                @yield('title')
                            </h3>
                        </div>
                        <div class="col text-right">
                            @yield('actions')
                            @include('admin.partials.entity.form.back')
                        </div>
                    </div>
                </div>
                @yield('form')
            </div>
        </div>
    </div>

    @yield('content_bottom')

@endsection