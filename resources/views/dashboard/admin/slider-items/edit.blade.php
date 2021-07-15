@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="ویرایش اسلایدر" route="dashboard.admin.slider-items.edit" />
@endsection
@section('content')
    <div class="container">
        <form action="{{ route('dashboard.admin.slider-items.update', $item) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-card type="info">
                <x-card-header>مشخصات اسلایدر</x-card-header>

                <x-card-body>
                    @include('dashboard.admin.slider-items.details-form', ['model' => $item])
                </x-card-body>

                <x-card-footer>
                    <button type="submit" class="btn btn-success">ویرایش</button>
                </x-card-footer>
            </x-card>
        </form>
    </div>
@endsection
