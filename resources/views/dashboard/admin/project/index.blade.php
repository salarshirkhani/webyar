@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/MDTimePicker/mdtimepicker.min.css') }}">
    <style>
        .mdtimepicker {
            direction: ltr;
            text-align: left;
        }
    </style>
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت پروژه ها" route="dashboard.admin.project.manage" />
    <x-breadcrumb-item title="{{ $post->title }}" route="dashboard.admin.project.index" />
@endsection
@section('content')
@include('dashboard.admin.phase.create', ['id' => $post->id])
@include('dashboard.admin.phase.updatepost', ['posts' => $phase, 'id' => $post->id])
@include('dashboard.admin.task.create', ['id' => $post->id, 'phase' => $phase, 'posts' => $users])
@include('dashboard.admin.task.updatetask', ['id' => $post->id, 'phase' => $phase, 'users' => $users, 'posts' => $tasks])
@include('dashboard.admin.employee.create', ['users' => $all_users, 'project' => $post])
@include('dashboard.admin.employee.updateemployee', ['posts' => $users, 'salaries' => $salaries])
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
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>{{ $post->title }}</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        {!! $post->description !!}
                        <div style="margin-bottom: 50px;"></div>
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">فاز بندی پروژه</h3>
                            </div>
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>حذف</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($phase as $item)
                             <?php $ids=$item->id ; ?>
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{!! $item->start_date->formatJalali() !!}</td>
                                    <td>{!! $item->finish_date->formatJalali() !!}</td>
                                    <td>
                                    <a href="{{route('dashboard.admin.phase.deletephase',['id'=>$item->id,'project_id'=>$item->for->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>
                                    </td>
                                    <td>
                                    <button type="button" data-toggle="modal" data-target="#modal-edit-phase-{{ $item->id }}" style="padding: 0;color:#dc3545" class="btn edit_post"><i class="fas fa-edit"></i></button>
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>عنوان</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ پایان</th>
                                    <th>حذف</th>
                                    <th>ویرایش</th>
                                </tr>
                                </tfoot>
                        </table>
                       </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-12 col-md-4 col-lg-3">
                                    <button type="button" data-toggle="modal" data-target="#modal-create-phase" class="btn btn-success">ثبت فاز جدید برای پروژه</button>
                                </div>
                            </div>
                        </div>
                    </div>
                       <div style="margin-bottom: 50px;"></div>
                       <div class="card">
                           <div class="card-header">
                             <h3 class="card-title">کاربران این پروژه</h3>
                           </div>
                       <div class="card-body">
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
                                 @foreach($users as $item)
                                    <tr>
                                        <td>{{ $item->for->first_name }} {{ $item->for->last_name }}</td>
                                        <td>{{ $item->for->email }}</td>
                                        <td>{{ $item->for->mobile }}</td>
                                        <td>{!! $item->start_date->formatJalali() !!}</td>
                                        <td>{!! $item->finish_date->formatJalali() !!}</td>
                                        <td>{{ $item->cost }}</td>
                                        <td><a href="{{route('dashboard.admin.users.profile',['id'=>$item->for->id])}}" class="btn btn-block btn-outline-primary btn-sm">مشاهده پروفایل</a></td>
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

                       <div class="card-footer">
                           <div class="row">
                               <div class="col-12 col-md-4 col-lg-3">
                                   <button type="button" data-toggle="modal" data-target="#modal-create-employee" class="btn btn-success">افزودن کاربر </button>
                               </div>
                           </div>
                       </div>

                        <!-- /.card-body -->
                        </div>

                        <div style="margin-bottom: 50px;"></div>
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">مسئولیت های این پروژه</h3>
                            </div>
                        <div class="card-body">
                         <table id="example2" class="table table-bordered table-hover">
                             <thead>
                                <tr>
                                    <th>عنوان</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ پایان</th>
                                    <th>فاز</th>
                                    <th>کاربر</th>
                                    <th>وضعیت</th>
                                    <th>حذف</th>
                                    <th>ویرایش</th>
                                </tr>
                                </thead>
                                    <tbody>
                                 @foreach($tasks as $item)
                                    <tr style="background-color: @if($item->status == 'notwork' && $item->finish_date->lt(now()->startOfDay())) #f4b9b9 @elseif($item->status == 'done') #a9ecb0 @else #fff @endif">
                                        <td>{{ $item->title }}</td>
                                        <td>{!! $item->start_date->formatJalali() !!}</td>
                                        <td>{!! $item->finish_date->formatJalali() !!}</td>
                                        <td>{{ !empty($item->phase) ? $item->phase->title : '' }}</td>
                                        <td>@if(!empty($item->for)){{ $item->for->first_name }} {{ $item->for->last_name }}@endif</td>
                                        <td>{{ __('app.status.' . $item->status) }}</td>
                                        <td>
                                        <a href="{{route('dashboard.admin.task.deletetask',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>
                                        </td>
                                        <td>
                                        <button type="button" data-toggle="modal" data-target="#modal-edit-task-{{ $item->id }}" style="padding: 0;color:#dc3545" class="btn edit_post"><i class="fas fa-edit"></i></button>
                                        </td>
                                    </tr>
                                 @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>عنوان</th>
                                        <th>تاریخ شروع</th>
                                        <th>تاریخ پایان</th>
                                        <th>فاز</th>
                                        <th>کاربر</th>
                                        <th>وضعیت</th>
                                        <th>حذف</th>
                                        <th>ویرایش</th>
                                    </tr>
                                     </tfoot>
                         </table>
                         </div>
                         <div class="card-footer">
                             <div class="row">
                                 <div class="col-12 col-md-4 col-lg-3">
                                     <button type="button" data-toggle="modal" data-target="#modal-create-task" class="btn btn-success">افزودن مسئولیت</button>
                                 </div>
                             </div>
                         </div>
                         <!-- /.card-body -->
                         </div>
                    </div>
                    </x-card-body>
            <x-card-footer>
                <div class="row">
                    <div class="col-12 col-md-4 col-lg-3">
                        @if($post->status != 'done')
                            <a class="btn btn-warning w-100 m-2" href="{{ route("dashboard.admin.project.updatestatus", ['id'=>$id,'status'=>'done']) }}">به اتمام‌رساندن پروژه</a>
                        @endif
                    </div>
                    <div class="col-12 col-md-4 col-lg-3">
                        @if($post->status != 'paid')
                            <a class="btn btn-success w-100 m-2" href="{{ route("dashboard.admin.project.updatestatus", ['id'=>$id,'status'=>'paid']) }}">پروژه تسویه شده</a>
                        @endif
                    </div>
                </div>
            </x-card-footer>
        </x-card>
    </div>
    @endsection

@section('scripts')
    <script src="{{ asset('assets/dashboard/plugins/MDTimePicker/mdtimepicker.min.js') }}"></script>
    <script>
        mdtimepicker('.mdtimepicker-input', {
            is24hour: true,
        });
        @if(Session::has('show-create-employee'))
            $(window).on('load', function() {
                $('#modal-create-employee').modal('show');
            });
        @endif
    </script>
@endsection
