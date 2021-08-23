@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت کارمند ها" route="dashboard.admin.project.manage" />
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
                    <div class="box-body">
                        <div style="margin-bottom: 50px;"></div>
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">کارمندان درگیر پروژه</h3>
                            </div>
                        <div class="card-body p-0">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام و نام خانوادگی</th>
                                <th>نام پروژه</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>هزینه</th>
                                <th>ایمیل</th>
                                <th>شماره تماس</th>
                                <th>مشاهده پروژه</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($employee as $item)
                             <?php $ids=$item->id ; ?>
                                <tr>
                                    <td>{{ $item->for->first_name }} {{ $item->for->last_name }}</td>
                                    <td>{{ $item->project->title }}</td>
                                    <td>{!! $item->start_date->formatJalali() !!}</td>
                                    <td>{!! $item->finish_date->formatJalali() !!}</td>
                                    <td>{{$item->cost}}</td>
                                    <td>{{ $item->for->email }}</td>
                                    <td>{{ $item->for->mobile }}</td>
                                    <td><a href="{{route('dashboard.admin.project.index',['id'=>$item->project->id])}}" class="btn btn-block bg-gradient-primary btn-sm">نمایش پروژه</a></td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>نام و نام خانوادگی</th>
                                    <th>نام پروژه</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ پایان</th>
                                    <th>هزینه</th>
                                    <th>ایمیل</th>
                                    <th>شماره تماس</th>
                                    <th>مشاهده پروژه</th>
                                </tr>
                                </tfoot>
                        </table>
                       </div>
                    </div>
                       <div style="margin-bottom: 50px;"></div>
                       <div class="card">
                           <div class="card-header">
                             <h3 class="card-title">کلیه کارمندان</h3>
                           </div>
                       <div class="card-body p-0">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام و نام خانوادگی </th>
                                <th>ایمیل</th>
                                <th>شماره تماس</th>
                                <th>پروفایل</th>
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
                                    <th>حذف</th>                                   
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
