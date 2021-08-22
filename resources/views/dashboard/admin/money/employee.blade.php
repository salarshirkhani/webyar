@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت پروژه ها" route="dashboard.admin.project.manage" />
    <x-breadcrumb-item title="مدیریت هزینه کاربران" route="dashboard.admin.money.employee" />
@endsection
@section('content')
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
<?php
$spend=0;
foreach ($employee as $key) {
    $spend=$key->cost+$spend;
}
?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>250000<sup style="font-size: 20px">هزارتومان</sup></h3>

                  <p>درامد این ماه</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
            <div class=" col-6">
              <!-- small box -->
              <div class="small-box bg-danger" >
                <div class="inner">
                    <h3><?php echo $spend; ?><sup style="font-size: 20px">هزارتومان</sup></h3>

                  <p>هزینه های انجام شده</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
              </div>
            </div>
            <!-- ./col -->
          </div>
        <x-card type="info">
            <x-card-header>مدیریت هزینه کاربران</x-card-header>
                <x-card-body>
                    <div class="box-body">
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
                             @foreach($employee as $item)
                                <tr>
                                    <td>{{ $item->for->first_name }} {{ $item->for->last_name }}</td>
                                    <td>{{ $item->for->email }}</td>
                                    <td>{{ $item->for->mobile }}</td>
                                    <td>{!! $item->start_date->formatJalali() !!}</td>
                                    <td>{!! $item->finish_date->formatJalali() !!}</td>
                                    <td>{{ $item->cost }}</td>
                                    <td><a href="{{route('dashboard.admin.users.profile',['id'=>$item->id])}}" class="btn btn-block btn-outline-primary btn-sm">مشاهده پروفایل</a></td>
                                    <td><a href="{{route('dashboard.admin.employee.updateemployee',['id'=>$item->id])}}"  class="btn btn-block bg-gradient-warning btn-sm">ویرایش</a></td>
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
                    </div>
                    </x-card-body>
                <x-card-footer>
                </x-card-footer>
        </x-card>
    </div>

    @endsection

