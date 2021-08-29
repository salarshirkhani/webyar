@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="لیست دستمزد ها" route="dashboard.admin.salary.index"/>
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
            <x-card-header>لیست دستمزدها</x-card-header>
            <x-card-body>
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>عنوان</th>
                        <th>مبلغ</th>
                        <th>حذف</th>
                        <th>ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salaries as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->amount }}</td>
                            <td>
                                <a href="{{route('dashboard.admin.salary.delete',['salary'=>$item])}}"
                                   class="delete_post"><i class="fa fa-fw fa-eraser"></i></a>
                            </td>
                            <td>
                                <a href="{{route('dashboard.admin.salary.edit',['salary'=>$item])}}" class="edit_post"
                                   target="_blank"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>عنوان</th>
                        <th>مبلغ</th>
                        <th>حذف</th>
                        <th>ویرایش</th>
                    </tr>
                    </tfoot>
                </table>
            </x-card-body>
            <x-card-footer>
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        <a href="{{ route('dashboard.admin.salary.create') }}" class="btn btn-success">
                            ساخت دستمزد جدید
                        </a>
                    </div>
                </div>
            </x-card-footer>
        </x-card>
    </div>
@endsection
