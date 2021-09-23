@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="ویرایش فاکتور" route="dashboard.admin.invoice.edit"/>
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
            <x-card-header>ویرایش فاکتور</x-card-header>
            <x-card-body>
                <form action="{{ route('dashboard.admin.invoice.update', ['invoice'=>$invoice]) }}"
                      method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
                    @method('PUT')
                    @include('dashboard.admin.invoice.form', ['model' => $invoice, 'customers' => $customers])
                    <x-text-group name="status" label="وضعیت" disabled :default="__('app.invoice_status.' . $invoice->status)" />
                    <p>لینک پرداخت: {{ route('dashboard.invoice.get', compact('invoice')) }}</p>
                    {{ csrf_field() }}
                </form>
            </x-card-body>
            <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"
                        class="btn btn-primary">ارسال
                </button>
            </x-card-footer>
        </x-card>
    </div>
@endsection
