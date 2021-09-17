@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت پروژه ها" route="dashboard.admin.project.manage" />
    <x-breadcrumb-item title="مدیریت کاربران پروژه" route="dashboard.admin.employee.manage" />
@endsection
@section('content')
@include('dashboard.admin.employee.updateemployee', ['posts' => $posts])
@if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>مدیریت کاربران پروژه {{$project->title}}</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        در اینجا می توانید کاربران پروژه را مدیریت کنید
                        <div style="margin-bottom: 50px;"></div>
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">کاربران در پروژه</h3>
                            </div>
                        <div class="card-body p-0">
                        <table id="example" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام و نام خانوادگی </th>
                                <th>ایمیل</th>
                                <th>شماره تماس</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>هزینه</th>
                                <th>پروفایل</th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($posts as $item)
                                <tr>
                                    <td>{{ $item->for->first_name }} {{ $item->for->last_name }}</td>
                                    <td>{{ $item->for->email }}</td>
                                    <td>{{ $item->for->mobile }}</td>
                                    <td>{!! $item->start_date->formatJalali() !!}</td>
                                    <td>{!! $item->finish_date->formatJalali() !!}</td>
                                    <td>
                                        @if ($item->cost == 0)
                                        توافقی
                                        @else
                                        {{ $item->cost }}
                                        @endif
                                </td>
                                    <td><a href="{{route('dashboard.admin.users.profile',['id'=>$item->id])}}" class="btn btn-block btn-outline-primary btn-sm">مشاهده پروفایل</a></td>
                                    <td><button type="button" data-toggle="modal" data-target="#modal-edit-employee-{{ $item->id }}" class="btn btn-block bg-gradient-warning btn-sm">ویرایش</button></td>
                                    <td>
                                    <a href="{{route('dashboard.admin.employee.deleteemployee',['id'=>$item->id,'project_id'=>$item->project->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>نام و نام خانوادگی </th>
                                    <th>ایمیل</th>
                                    <th>شماره تماس</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ پایان</th>
                                    <th>هزینه</th>
                                    <th>پروفایل</th>
                                    <th>ویرایش</th>
                                    <th>حذف</th>
                                </tr>
                                </tfoot>
                        </table>
                       </div>
                    </div>
                       <div style="margin-bottom: 50px;"></div>
                       <div class="card">
                           <div class="card-header">
                             <h3 class="card-title">کاربران</h3>
                           </div>
                       <div class="card-body p-0">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام و نام خانوادگی </th>
                                <th>ایمیل</th>
                                <th>شماره تماس</th>
                                <th>پروفایل</th>
                                <th>اضافه کردن به پروژه</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($users as $item)
                             <?php $ids=$item->id ; ?>
                                <tr>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td><button type="button" class="btn btn-block btn-outline-primary btn-sm">مشاهده پروفایل</button></td>
                                    <td>
                                    <form style="padding:10px;" action="{{ route('dashboard.admin.employee.create',['id'=>$id]) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
                                         <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="project_id" value="{{ $id }}" >
                                         <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="employee_id" value="{{ $item->id }}" >
                                         <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="start_date" value="{{ $project->start_date->formatJalali() }}" >
                                         <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="finish_date" value="{{ $project->finish_date->formatJalali()  }}" >
                                         <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="cost" value="0" >
                                         @csrf
                                         <button type="submit" class="btn btn-block bg-gradient-success btn-sm">افزودن به پروژه</button>
                                    </form>
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
                                    <th>اضافه کردن به پروژه</th>
                                </tr>
                                </tfoot>
                        </table>
                        </div>

                        <!-- /.card-body -->
                        </div>
                    </div>
                    </x-card-body>
                <x-card-footer>
                </x-card-footer>
        </x-card>
    </div>

    @endsection

