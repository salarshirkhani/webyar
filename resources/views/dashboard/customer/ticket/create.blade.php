@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.customer.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.customer.index"/>
    <x-breadcrumb-item title="ارسال درخواست پشتیبانی" route="dashboard.customer.ticket.create"/>
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
            <form style="padding:10px;" action="{{ route('dashboard.customer.ticket.store') }}" method="post"
                  role="form" class="form-horizontal " enctype="multipart/form-data">
            <x-card-header>ارسال درخواست پشتیبانی</x-card-header>
                @csrf
                <x-card-body>
                    <x-text-group required name="title" label="عنوان" />
                    <x-text-group required name="department" label="دپارتمان" />
                    <x-textarea-group required id="description" name="content" label="پیام"></x-textarea-group>
                    <x-file-group name="file" label="پیوست" />
                </x-card-body>
                <x-card-footer>
                    <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"
                            class="btn btn-primary">ارسال
                    </button>
                </x-card-footer>
            </form>
        </x-card>
    </div>
@endsection
