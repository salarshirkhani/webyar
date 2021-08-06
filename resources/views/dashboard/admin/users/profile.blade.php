@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('title', __('پروفایل'))
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="پروفایل" route="dashboard.admin.users.profile" />
@endsection
@section('content')
    <div class="container">
      <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg" alt="علی">
                </div>

                <h3 class="profile-username text-center">علی مطهری</h3>

                <p class="text-muted text-center">مهندس نرم افزار</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>تسک های انجام شده</b> <a class="float-right">1,322</a>
                  </li>
                  <li class="list-group-item">
                    <b>امتیاز</b> <a class="float-right">4.3</a>
                  </li>
                  <li class="list-group-item">
                    <b>تاریخ تولد</b> <a class="float-right">1387</a>
                  </li>
                </ul>
                <a href="#" class="btn btn-warning btn-block"><b>ارسال پیام</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-9">
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
                      <a href="#" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
                  <div class="col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger" style="background: #358e82 !important">
                      <div class="inner">
                        <h3>65</h3>
          
                        <p>تسک های انجام شده</p>
                      </div>
                      <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="#" class="small-box-footer">اطلاعات بیشتر<i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
@endsection
