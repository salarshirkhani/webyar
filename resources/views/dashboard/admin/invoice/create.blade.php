@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="افزودن فاکتور" route="dashboard.admin.invoice.create"/>
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
        <x-card type="info">
            <x-card-header>ساخت فاکتور جدید</x-card-header>
            <x-card-body>
                <form style="padding:10px;" action="{{ route('dashboard.admin.invoice.store') }}" method="post"
                      role="form" class="form-horizontal " enctype="multipart/form-data">

                    @include('dashboard.admin.invoice.form', compact('customers'))

                    {{ csrf_field() }}
                    <x-card-footer>
                        <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"
                                class="btn btn-primary">ارسال
                        </button>
                    </x-card-footer>
                </form>
            </x-card-body>
        </x-card>
    </div>
@endsection
