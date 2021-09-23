@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="لیست فاکتورها" route="dashboard.admin.invoice.index"/>
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
            <x-card-header>لیست فاکتورها</x-card-header>
            <x-card-body>
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>عنوان</th>
                        <th>مبلغ</th>
                        <th>وضعیت</th>
                        <th style="width: 75px">حذف</th>
                        <th style="width: 75px">ویرایش</th>
                        <th style="width: 75px">مشاهده</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($invoices as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>{{ __('app.invoice_status.' . $item->status) }}</td>
                            <td>
                                <form method="post" action="{{ route('dashboard.admin.invoice.destroy', ['invoice' => $item]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button style="color: #dc3545;background: none;border: none;" type="submit" class="delete_post"><i class="fa fa-fw fa-eraser"></i></button>
                                </form>
                            </td>
                            <td>
                                <a href="{{route('dashboard.admin.invoice.edit',['invoice'=>$item])}}" class="edit_post"
                                   target="_blank"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="{{route('dashboard.invoice.get',['invoice'=>$item])}}" class="edit_post"
                                   target="_blank"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>عنوان</th>
                        <th>مبلغ</th>
                        <th>وضعیت</th>
                        <th>حذف</th>
                        <th>ویرایش</th>
                        <th>مشاهده</th>
                    </tr>
                    </tfoot>
                </table>
            </x-card-body>
            <x-card-footer>
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        <a href="{{ route('dashboard.admin.invoice.create') }}" class="btn btn-success">
                            ساخت فاکتور جدید
                        </a>
                    </div>
                </div>
            </x-card-footer>
        </x-card>
    </div>
@endsection
