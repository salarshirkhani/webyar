@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت کارمند ها" route="dashboard.admin.users.employee" />
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
            <x-card-header>مدیریت کارمندان</x-card-header>
            <x-card-body>
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>نام و نام خانوادگی </th>
                        <th>ایمیل</th>
                        <th>شماره تماس</th>
                        <th>پروفایل</th>
                        <th>ویرایش</th>
                        <th>حذف</th>
                    </tr>
                    </thead>
                        <tbody>
                     @foreach($users as $item)
                     <?php $ids=$item->id ; ?>
                        <tr>
                            <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td><a href="{{route('dashboard.admin.users.profile',['id'=>$item->id])}}" class="btn btn-block btn-outline-primary btn-sm">مشاهده پروفایل</a></td>
                            <td>
                                @if($item->trashed())
                                    <a href="{{route('dashboard.admin.users.restore',['id'=>$item->id])}}" class="edit_post"><i class="fas fa-undo"></i> بازگردانی</a>
                                @else
                                    <a href="{{route('dashboard.admin.users.updateuser',['id'=>$item->id])}}" class="edit_post" target="_blank"><i class="fas fa-edit"></i></a>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('dashboard.admin.users.deleteuser',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>
                            </td>
                        </tr>
                     @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>نام و نام خانوادگی </th>
                            <th>ایمیل</th>
                            <th>شماره تماس</th>
                            <th>پروفایل</th>
                            <th>ویرایش</th>
                            <th>حذف</th>
                        </tr>
                        </tfoot>
                </table>
            </x-card-body>
        </x-card>
    </div>
    @endsection
