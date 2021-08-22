@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.employee.notification')
    @include('dashboard.employee.sidebar')
@endsection
@section('title', __('مدیریت مالی'))
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.employee.index" />
    <x-breadcrumb-item title="مدیریت مالی" route="dashboard.employee.money.index" />
@endsection
@section('content')
<?php
$tasks=0;
$income=0;
foreach ($employee as $item) {
  $income=$item->cost+$income;
}
foreach ($task as $item) {
  if($item->status=='done')
     $tasks++;
}
?>

    <div class="container">
      <div class="row">

          <div class="col-md-12">
              <div class="row">
                <div class="col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                      <div class="inner">
                        <h3><?php echo $income; ?><sup style="font-size: 20px">هزارتومان</sup></h3>

                        <p>درآمد </p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger" style="background: #358e82 !important">
                      <div class="inner">
                        <h3><?php echo $tasks; ?></h3>

                        <p>تسک های انجام شده</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <x-card type="info">
                        <x-card-header>پروژه ها</x-card-header>
                            <x-card-body>
                                <div class="box-body">
                                    <table id="example3" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>نام پروژه</th>
                                            <th>تاریخ شروع</th>
                                            <th>تاریخ پایان</th>
                                            <th>درآمد</th>
                                        </tr>
                                        </thead>
                                            <tbody>
                                         @foreach($employee as $item)
                                            <tr>
                                                <td>{{ $item->project->title }}</td>
                                                <td>{!! $item->project->start_date->formatJalali() !!}</td>
                                                <td>{!! $item->project->finish_date->formatJalali() !!}</td>
                                                <td>{{$item->cost}} تومان</td>
                                            </tr>
                                         @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>نام پروژه</th>
                                                <th>تاریخ شروع</th>
                                                <th>تاریخ پایان</th>
                                                <th>درآمد</th>
                                            </tr>
                                            </tfoot>
                                    </table>
                                </div>
                                </x-card-body>
                            <x-card-footer>
                            </x-card-footer>
                    </x-card>
                    <div style="margin-top:50px;"></div>
                    <x-card type="info">
                        <x-card-header>تسک ها</x-card-header>
                            <x-card-body>
                                <div class="box-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>عنوان</th>
                                            <th>تاریخ شروع</th>
                                            <th>تاریخ پایان</th>
                                            <th>وضعیت</th>
                                            <th>ویرایش</th>
                                        </tr>
                                        </thead>
                                            <tbody>
                                         @foreach($task as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>{{ $item->start_date->formatJalali() }}</td>
                                                <td>{{$item->finish_date->formatJalali()}}</td>
                                                <td>
                                                  @if ($item->status=='done')
                                                    <p style="color:green;"> انجام شده </p>
                                                  @else
                                                    <p style="color:red;">انجام نشده</p>
                                                  @endif
                                                </td>
                                                <td>
                                                <a href="{{route('dashboard.admin.task.updatetask',['id'=>$item->id])}}" class="edit_post" target="_blank"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                         @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>عنوان</th>
                                                <th>تاریخ شروع</th>
                                                <th>تاریخ پایان</th>
                                                <th>وضعیت</th>
                                                <th>ویرایش</th>
                                            </tr>
                                            </tfoot>
                                    </table>
                                </div>
                                </x-card-body>
                            <x-card-footer>
                            </x-card-footer>
                    </x-card>
                </div>
              </div>
          </div>
      </div>
    </div>
@endsection
