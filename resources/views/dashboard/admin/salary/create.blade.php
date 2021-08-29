@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="افزودن دستمزد" route="dashboard.admin.salary.create"/>
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
            <x-card-header>ساخت دستمزد جدید</x-card-header>
            <form style="padding:10px;" action="{{ route('dashboard.admin.salary.create') }}" method="post"
                  role="form" class="form-horizontal " enctype="multipart/form-data">
                <div class="form-group">
                    <label>عنوان</label>
                    <input type="text"
                           style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                           class="form-control" required name="title" placeholder="عنوان">

                </div>
                <div class="form-group">
                    <label>مبلغ</label>
                    <input type="number"
                           style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                           class="form-control" required name="amount" placeholder="مبلغ">

                </div>
                {{ csrf_field() }}
                <x-card-footer>
                    <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"
                            class="btn btn-primary">ارسال
                    </button>
                </x-card-footer>
            </form>
        </x-card>
    </div>
@endsection
