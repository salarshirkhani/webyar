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
@include('dashboard.admin.employee.updateemployee', ['posts' => $employee, 'salaries' => $salaries])

    <?php
$spend=0;
foreach ($employee as $key) {
    $spend += empty($key->salary) ? 0 : $key->salary->amount;
}
?>
    <div class="col-md-12">
        <div class="row">
            <div class="col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>250000<sup style="font-size: 13px; top:0px;">هزارتومان</sup></h3>

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
                    <h3><?php echo $spend; ?><sup style="font-size: 13px; top:0px;">هزارتومان</sup></h3>

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
                <table id="example" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>نام و نام خانوادگی </th>
                        <th>پروژه</th>
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
                            <td>{{ $item->project->title }}</td>
                            <td>{!! $item->start_date->formatJalali() !!}</td>
                            <td>{!! $item->finish_date->formatJalali() !!}</td>
                            <td>{{ empty($item->salary) ? '' : $item->salary->amount }}</td>
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
                            <th>پروژه</th>
                            <th>تاریخ شروع</th>
                            <th>تاریخ پایان</th>
                            <th>هزینه</th>
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

