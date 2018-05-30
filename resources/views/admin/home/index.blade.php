@extends('admin.layouts.main')

@section('content')
    <h1>Главная</h1>
    <h2>Route: {{ request()->route()->getName() }}</h2>
@endsection