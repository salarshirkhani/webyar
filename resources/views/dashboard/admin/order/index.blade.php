@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="لیست سفارشات" route="dashboard.admin.order.index" />
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
            <x-card-header>لیست سفارشات</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>کاربر</th>
                                <th>مبلغ کل</th>
                                <th>وضعیت</th>
                                <th>مشاهده</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($orders as $item)
                                <tr>
                                    <td>{{ $item->user->first_name }} {{ $item->user->last_name }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>{{ empty($item->invoice) ? 'نامعلوم' : __('app.invoice_status.' . $item->invoice->status) }}</td>
                                    <td>
                                    <a href="{{ route('dashboard.admin.order.show', ['order' => $item]) }}" class="edit_post"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>کاربر</th>
                                    <th>مبلغ کل</th>
                                    <th>وضعیت</th>
                                    <th>مشاهده</th>
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
        </x-card>
    </div>
    @endsection
