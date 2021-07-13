@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="افزودن دسته‌بندی" route="dashboard.admin.categories.create" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
        <form action="{{ route('dashboard.admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-card type="info">
                <x-card-header>مشخصات دسته‌بندی</x-card-header>

                <x-card-body>
                    @include('dashboard.admin.categories.form')
                </x-card-body>

                <x-card-footer>
                    <button type="submit" class="btn btn-success">ثبت</button>
                </x-card-footer>
            </x-card>
        </form>
    </div>
@endsection