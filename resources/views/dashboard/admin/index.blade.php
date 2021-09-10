@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('title', __('داشبورد'))
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
@endsection
@section('content')
<?php
$projects=0;
$employees=0;
foreach ($posts as $key) {
    $projects++;
}
foreach ($users as $key) {
    $employees++;
}
?>
    <div class="container">
        <div class="row">
        @if(!empty($finishing_projects) || !empty($finishing_phases))
            <div class="col-12">
                @foreach($finishing_projects as $project)
                    <div class="alert alert-danger no-dismiss">
                        پروژه {{ $project->title }} در تاریخ {{ $project->finish_date->formatJalali() }} به پایان
                        خواهد رسید!
                    </div>
                @endforeach
                @foreach($finishing_phases as $phase)
                    <div class="alert alert-danger no-dismiss">
                        فاز {{ $phase->title }} از پروژه {{ $phase->for->title }} در
                        تاریخ {{ $phase->finish_date->formatJalali() }} به پایان خواهد رسید!
                    </div>
                @endforeach
            </div>
        @endif
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>150</h3>

              <p>سفارش جدید</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>250000<sup style="font-size: 20px">هزارتومان</sup></h3>

              <p>درامد این ماه</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?php echo $employees ; ?></h3>

              <p>همکاران جدید</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('dashboard.admin.users.employee')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger" style="background: #358e82 !important">
            <div class="inner">
              <h3><?php echo $projects ; ?></h3>

              <p>پروژه های انجام شده</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('dashboard.admin.project.manage')}}" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
    </div>
@endsection
