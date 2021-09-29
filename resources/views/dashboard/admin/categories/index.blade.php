@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('title', __('داشبورد'))
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="لیست دسته‌بندی‌ها" route="dashboard.admin.category.index" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
        <x-card>
            <x-card-header>لیست دسته‌بندی‌ها</x-card-header>
            <x-card-body>
                <table id="example2" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام</th>
                        <th>نام انگلیسی</th>
                        <th style="width: 15vw">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>@if(!empty($category->parent_id))@for($i = 2; $i <= $category->level; $i ++)&nbsp;&nbsp;&nbsp;@endfor&#x2500;&#x251c; @endif{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <a href="{{ route('dashboard.admin.category.edit', $category) }}" class="btn btn-sm btn-primary">ویرایش</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </x-card-body>
            <x-card-footer>
                <a href="{{ route('dashboard.admin.category.create') }}" class="btn btn-success">افزودن دسته‌بندی</a>
            </x-card-footer>
        </x-card>
    </div>
@endsection
