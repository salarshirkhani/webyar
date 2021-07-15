@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('title', __('داشبورد'))
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
        <x-card>
            <x-card-body>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>اولویت</th>
                        <th>عنوان</th>
                        <th style="width: 15vw">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sliderItems as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->priority }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <form method="POST" action="{{ route('dashboard.admin.slider-items.destroy', $item) }}">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ route('dashboard.admin.slider-items.edit', $item) }}" class="btn btn-sm btn-primary">ویرایش</a>
                                    <button type="submit" class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-card-body>
        </x-card>
    </div>
@endsection
