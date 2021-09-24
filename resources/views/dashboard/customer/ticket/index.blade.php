@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.customer.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.customer.index"/>
    <x-breadcrumb-item title="لیست درخواست‌های پشتیبانی" route="dashboard.customer.ticket.index"/>
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
            <x-card-header>لیست درخواست‌های پشتیبانی</x-card-header>
            <x-card-body>
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>عنوان</th>
                        <th style="width: 75px">مشاهده</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>
                                <a href="{{route('dashboard.customer.ticket.show',['ticket' => $item])}}" class="edit_post"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>عنوان</th>
                        <th>مشاهده</th>
                    </tr>
                    </tfoot>
                </table>
            </x-card-body>
            <x-card-footer>
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        <a href="{{ route('dashboard.customer.ticket.create') }}" class="btn btn-success">
                            ارسال درخواست پشتیبانی جدید
                        </a>
                    </div>
                </div>
            </x-card-footer>
        </x-card>
    </div>
@endsection
