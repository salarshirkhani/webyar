@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.' . Auth::user()->type . '.sidebar')
@endsection
@section('title', __('داشبورد'))
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" :route="'dashboard.' . Auth::user()->type . '.index'"/>
    <x-breadcrumb-item title="مشاهده فاکتور" route="dashboard.invoice.get"/>
@endsection
@section('content')
    <form method="post" action="{{ route('dashboard.invoice.pay', ['invoice' => $invoice]) }}">
        @csrf
        @if(Session::has('info'))
            <div class="row">
                <div class="col-md-12">
                    <p class="alert alert-info">{{ Session::get('info') }}</p>
                </div>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="row">
                <div class="col-md-12">
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                </div>
            </div>
        @endif
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <i class="fas fa-globe"></i> {{ $invoice->title }}
                        <small class="float-right">تاریخ: {{ $invoice->created_at->formatJalali() }}</small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    صادرکننده
                    <address>
                        <strong>WebYar</strong><br>
                        آدرس ۱<br>
                        آدرس ۲<br>
                        ایمیل: test@gmail.com<br>
                        تلفن ثابت: 02122221111<br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    @if(!empty($invoice->user))
                    به نام
                    <address>
                        <strong>{{ $invoice->user->first_name }} {{ $invoice->user->last_name }}</strong><br>
                        ایمیل: {{ $invoice->user->email }}<br>
                        تلفن: {{ $invoice->user->mobile }}<br>
                    </address>
                    @endif
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>فاکتور شماره {{ $invoice->id }}</b><br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
            </div>

            <div class="row">
                <div class="col-12">
                    <p class="lead">توضیحات</p>
                    <p>
                        {!! $invoice->description !!}
                    </p>
                </div>
                <!-- accepted payments column -->
                <div class="col-6">
                    @if($invoice->status != \App\Models\Invoice::STATE_PAID)
                        <p class="lead">روش‌های پرداختی:</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gateway" id="gateway_zarinpal" value="zarinpal" checked>
                            <label class="form-check-label" for="gateway_zarinpal">
                                پرداخت با زرین‌پال
                            </label>
                        </div>
                    @endif
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">مبلغ</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th>هزینه نهایی:</th>
                                <td>{{ $invoice->amount }} تومان</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            @if($invoice->status != \App\Models\Invoice::STATE_PAID)
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                            انتقال به درگاه پرداخت
                        </button>
                    </div>
                </div>
            @endif
        </div>
    </form>
@endsection
