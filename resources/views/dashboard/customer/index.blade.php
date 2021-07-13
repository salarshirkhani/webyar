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
        <form action="{{ route('dashboard.customer.search') }}" method="GET">
            <x-card type="success">
                <x-card-header>
                    <div class="text-center">به دنبال چه چیزی می‌گردید؟</div>
                </x-card-header>

                <x-card-body>
                    <div class="form-row">
                        <x-select-group name="type" label="نوع هدف" width="col-md-6">
                            <x-select-item value="company">دنبال یک شرکت می‌گردم</x-select-item>
                            <x-select-item value="product">دنبال یک محصول می‌گردم</x-select-item>
                            <x-select-item value="service">دنبال یک سرویس یا خدمت می‌گردم</x-select-item>
                        </x-select-group>

                        <x-select-group name="category" label="دسته‌بندی موردنظر" width="col-md-6">
                            @foreach($categories as $category)
                                <x-select-item :value="$category->id" :data-type="$category->type">{{ $category->name }}</x-select-item>
                            @endforeach
                        </x-select-group>
                    </div>

                    <x-text-group name="keywords" label="کلمات کلیدی (با ، یا , جدا کنید)"/>
                </x-card-body>

                <x-card-footer>
                    <button type="submit" class="btn btn-outline-primary">جستجو</button>
                </x-card-footer>
            </x-card>
        </form>
    </div>
@endsection
