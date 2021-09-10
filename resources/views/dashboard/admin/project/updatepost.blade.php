@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="ویرایش پروژه" route="dashboard.admin.project.updatepost" />
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
            <x-card-header>ویرایش پروژه ها</x-card-header>
        <form style="padding:10px;" action="{{ route('dashboard.admin.project.updatepost', $post->id) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="id" value="{{ $post->id }}" >
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title" value="{{ $post->title }}" placeholder="عنوان">
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" value="" name="description"  placeholder="توضیحات">{{ $post->description }}</textarea>
            <div class="form-group">
                <label>تاریخ شروع:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                  </div>
                  <input name="start_date" type="text" id="date" value="{{ $post->start_date->formatJalali() }}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                </div>
                <!-- /.input group -->
            </div>

            <div class="form-group">
                <label>تاریخ پایان:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input name="finish_date" value="{{ $post->finish_date->formatJalali() }}" type="text" id="date1" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                </div>
                <!-- /.input group -->
            </div>

            <x-select-group label="وضعیت" name="status" :model="$post">
                <x-select-item value="not_done">{{ __('app.status.not_done') }}</x-select-item>
                <x-select-item value="delayed">{{ __('app.status.delayed') }}</x-select-item>
                <x-select-item value="in_progress">{{ __('app.status.in_progress') }}</x-select-item>
                <x-select-item value="done">{{ __('app.status.done') }}</x-select-item>
                <x-select-item value="paid">{{ __('app.status.paid') }}</x-select-item>
            </x-select-group>
            {{ csrf_field() }}
             <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
             </x-card-footer>
            </form>
    </x-card>
    </div>
    @endsection
