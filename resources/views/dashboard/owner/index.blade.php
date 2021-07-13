@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.owner.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.owner.index" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
    </div>
@endsection
