@extends('admin.root')

@section('layout')
    <div class="page-main">
        <div class="header py-4">
            <div class="container">
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="my-3 my-md-5">
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>
@endsection