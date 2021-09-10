@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت پروژه ها" route="dashboard.admin.project.manage" />
    <x-breadcrumb-item title="مدیریت مسئولیت ها" route="dashboard.admin.phase.tasks" />
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
        <x-card-header>ساخت مسئولیت برای فاز {{$phase->title}}</x-card-header>
    <form style="padding:10px;" action="{{ route('dashboard.admin.task.create',['id'=>$id]) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
        <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title"  placeholder="عنوان">
        <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" required name="description"  placeholder="توضیحات مسئولیت"></textarea>
        <input type="hidden" name="project_id" value="{{ $phase->project_id }}" >
        <input type="hidden" name="phase_id" value="{{$phase->id}}">
        <input type="hidden" name="status" value="notwork" >
        <div class="form-group">
            <label>تاریخ شروع:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input id="date" name="start_date" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy,mm,dd" data-mask="">
            </div>
            <!-- /.input group -->
        </div>
        <div class="form-group">
            <label>تاریخ پایان:</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
              </div>
              <input name="finish_date" type="text" id="date1" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy,mm,dd" data-mask="">
            </div>
            <!-- /.input group -->
        </div>
        <div class="form-group">
            <label>ساعت شروع:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input name="start_time" type="text" class="form-control mdtimepicker-input">
            </div>
            <!-- /.input group -->
        </div>
        <div class="form-group">
            <label>ساعت پایان:</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input name="finish_time" type="text" class="form-control mdtimepicker-input">
            </div>
            <!-- /.input group -->
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="ignore_conflict" id="ignore_conflict">
                <label class="form-check-label" for="ignore_conflict">
                    صرف‌نظر کردن از تداخل زمانی
                </label>
            </div>
        </div>
        <x-select-group label="نوع زمان‌بندی" name="continuity" :model="$model ?? null">
            <x-select-item value="">پیش‌فرض</x-select-item>
            <x-select-item value="1d">نمایش در هر روز</x-select-item>
            <x-select-item value="2d">نمایش یک روز در میان</x-select-item>
        </x-select-group>
        <x-select-group name="employee_id" label="کاربر" :model="$model ?? null">
            @foreach($posts as $item)
            <x-select-item :value="$item->id">{{ $item->for->first_name }} {{ $item->for->last_name }}</x-select-item>
            @endforeach
        </x-select-group>
          {{ csrf_field() }}
         <x-card-footer>
            <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
         </x-card-footer>
        </form>
</x-card>
</div>
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>مدیریت مسئولیت های {{$phase->title}}</x-card-header>
                <x-card-body>
                    <div class="box-body">
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
                             @foreach($task as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->start_date->formatJalali() }}</td>
                                    <td>{{$item->finish_date->formatJalali()}}</td>
                                    <td>{{ $item->phase->title }}</td>
                                    <td>{{ $item->for->first_name }} {{ $item->for->last_name }}</td>
                                    <td>{{ __('app.status.' . $item->status) }}</td>
                                    <td>
                                    <a href="{{route('dashboard.admin.task.deletetask',['id'=>$item->id,'project_id'=>$item->for->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>
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
                                    <th>فاز</th>
                                    <th>کاربر</th>
                                    <th>وضعیت</th>
                                    <th>حذف</th>
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
    @endsection
