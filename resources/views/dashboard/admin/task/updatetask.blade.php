@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="ویرایش تسک پروژه" route="dashboard.admin.task.updatetask" />
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
            <x-card-header>ویرایش تسک پروژه</x-card-header>
        <form style="padding:10px;" action="{{ route('dashboard.admin.task.updatetask', $post->id) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title" value="{{ $post->title }}" placeholder="عنوان">
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" value="" name="description"  placeholder="توضیحات">{{ $post->description }}</textarea>
            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="id" value="{{ $post->id }}" >
            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="project_id" value="{{ !empty($post->project->id) ? $post->project->id : '' }}" >
            <x-select-group name="employee_id" label="کاربر" :model="$model ?? null">
                <x-select-item :value="$post->for->id ">{{ $post->for->first_name }} {{ $post->for->last_name }}</x-select-item>
                @foreach($posts as $item)
                <x-select-item :value="$item->id">{{ $item->for->first_name }} {{ $item->for->last_name }}</x-select-item>
                @endforeach
            </x-select-group>
            <x-select-group name="phase_id" label="فاز بندی" :model="$model ?? null">
                @foreach($phase as $item)
                <x-select-item :value="$item->id">{{ $item->title }}</x-select-item>
                @endforeach
            </x-select-group>
            <div class="form-group">
                <label>تاریخ شروع:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input id="date" name="start_date" type="text" value="{{ $post->start_date->formatJalali() }}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                </div>
                <!-- /.input group -->
            </div>
            <div class="form-group">
                <label>تاریخ پایان:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input id="date1" name="finish_date" value="{{ $post->finish_date->formatJalali() }}" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                </div>
                <!-- /.input group -->
            </div>
            <input type="text" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="status" value="{{ $post->status }}" >
             {{ csrf_field() }}
             <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
             </x-card-footer>
            </form>
    </x-card>
    </div>
    @endsection
