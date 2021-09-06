@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.customer.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.customer.index" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
    </div>
@endsection
