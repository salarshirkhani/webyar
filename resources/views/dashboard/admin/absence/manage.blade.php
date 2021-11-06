@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="حضور غیاب" route="dashboard.admin.absence.manage" />
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
            <x-card-header>مدیریت حضور غیاب ها</x-card-header>
                <x-card-body>
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>کاربر</th>
                            <th>تاریخ</th>
                            <th>ساعت ورود</th>
                            <th>ساعت خروج</th>
                            <th>مقدار ساعت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($absence as $item)
                            <tr>
                                <td>{{ $item->for->first_name }} {{ $item->for->last_name }}</td>
                                <td>{!! Facades\Verta::instance($item->date)->formatDate() !!}</td>
                                <td>{{ $item->enter }}</td>
                                <td>{{ $item->exit }}</td>
                                <td>{{ \Carbon\CarbonInterval::seconds((int)$item->hours)->cascade()->forHumans(['join' => true]) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>کاربر</th>
                            <th>تاریخ</th>
                            <th>ساعت ورود</th>
                            <th>ساعت خروج</th>
                            <th>مقدار ساعت</th>
                        </tr>
                        </tfoot>
                    </table>
                </x-card-body>
        </x-card>
    </div>

    @endsection

