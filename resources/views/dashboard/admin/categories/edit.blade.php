@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="ویرایش دسته‌بندی" route="dashboard.admin.categories.edit" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
        <form action="{{ route('dashboard.admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-card type="info">
                <x-card-header>مشخصات دسته‌بندی</x-card-header>

                <x-card-body>
                    @include('dashboard.admin.categories.form', ['model' => $category])
                </x-card-body>

                <x-card-footer>
                    <button type="submit" class="btn btn-success">ویرایش</button>
                </x-card-footer>
            </x-card>
        </form>
    </div>
@endsection