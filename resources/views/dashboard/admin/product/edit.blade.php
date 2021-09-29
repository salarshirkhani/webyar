@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="ویرایش محصول" route="dashboard.admin.product.edit"/>
@endsection
@section('content')
    @if(Session::has('info'))
        <div class="row">
            <div class="col-md-12">
                <p class="alert alert-info">{{ Session::get('info') }}</p>
            </div>
        </div>
    @endif
    <div class="col-md-12">
        <form action="{{ route('dashboard.admin.product.update', $product) }}" method="post"
              role="form" class="form-horizontal " enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-card type="info">
                <x-card-header>ویرایش محصول ها</x-card-header>
                <x-card-body>
                    @include('dashboard.admin.product.form', ['model' => $product])
                </x-card-body>
                <x-card-footer>
                    <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"
                            class="btn btn-primary">ارسال
                    </button>
                </x-card-footer>
            </x-card>
        </form>
    </div>
@endsection
