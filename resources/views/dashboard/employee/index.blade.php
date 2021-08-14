@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.employee.notification')
    @include('dashboard.employee.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.employee.index" />
@endsection
@section('content')
<?php
$tasks=0;
$notwork=0;
$income=0;
foreach ($employee as $item) {
  $income=$item->cost+$income;
}
foreach ($task as $item) {
  if($item->status=='done')
     $tasks++;
  else
     $notwork++;
}
?>
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $notwork; ?></h3>

              <p>تسک های انجام نشده</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('dashboard.employee.task.manage')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?php echo $income; ?><sup style="font-size: 20px">هزارتومان</sup></h3>

              <p>درآمد این ماه</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('dashboard.employee.money.index')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
          <!-- small box -->
          <div class="small-box bg-danger" style="background: #358e82 !important">
            <div class="inner">
              <h3><?php echo $tasks; ?></h3>

              <p>تسک های انجام شده</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('dashboard.employee.task.manage')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div> 
    </div>
@endsection
