<?php use Hekmatinasser\Verta\Verta; ?>
@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.employee.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.employee.index" />
    <x-breadcrumb-item title="مدیریت تسک ها" route="dashboard.employee.task.manage" />
@endsection
@section('content')
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-success">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
@include('dashboard.employee.task.create')
<div class="row">
    <!-- SIDE 1 -->
    <section class="col-lg-4 connectedSortable">
                    <!-- TO DO List -->
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            کارهای امروز و ضروری
          </h3>

          <div class="card-tools">

          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <ul class="todo-list" data-widget="todo-list">
            @foreach ($task as $item)
            <?php $v1 = verta(); $v2=Facades\Verta::parse($item->finish_date); ?>
            @if ( $v1->diffDays($v2)<='0')
            @if ( $v1->diffDays($v2)<'0')
              <li style="background:#ff7c7c">
              @else
              <li>
              @endif
              <form  action="{{ route('dashboard.employee.task.updatetask', $item->id) }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $item->id }}" >
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div  class="icheck-primary d-inline ml-2">
                <input type="checkbox" value="done" name="status" id="todoCheck2" onchange="this.form.submit();">
                <label for="todoCheck2"></label>
              </div>              
              <span class="text">{{ $item->title }}</span>  
              <small class="badge badge-info"><i class="far fa-clock"></i>{{$item->finish_date}}</small>
              <div class="tools">

              </div>
            </form>
            </li>    
            @endif
            @endforeach
          </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <button type="button" data-toggle="modal" data-target="#modal-lg" style="font-size:13px;" class="btn btn-info float-right"><i class="fas fa-plus"></i>اضافه کردن کارت</button>
        </div>
      </div>
    </section>
     <!-- SIDE 2 -->
<section class="col-lg-4 connectedSortable">
    <!-- TO DO List -->
<div class="card">
    <div class="card-header">
      <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        کارهای فردا
      </h3>

      <div class="card-tools">

      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <ul class="todo-list" data-widget="todo-list">
        @foreach ($task as $item)
        <?php $v1 = verta(); $v2=Facades\Verta::parse($item->finish_date); ?>
        @if ( $v1->diffDays($v2)=='1')
        <li> 
          <form  action="{{ route('dashboard.employee.task.updatetask', $item->id) }}" method="post">
          @csrf
          <input type="hidden" name="id" value="{{ $item->id }}" >
          <span class="handle">
            <i class="fas fa-ellipsis-v"></i>
            <i class="fas fa-ellipsis-v"></i>
          </span>
          <div  class="icheck-primary d-inline ml-2">
               <input type="checkbox" value="done" name="status" id="todoCheck2" onchange="this.form.submit();">
            <label for="todoCheck2"></label>
          </div>
          <span class="text">{{ $item->title }}</span>
          <small class="badge badge-info"><i class="far fa-clock"></i>{{$item->finish_date}}</small>
          <div class="tools">

          </div>
        </form>
        </li>     
        @endif
        @endforeach
      </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <button type="button"  data-toggle="modal" data-target="#modal-lg" style="font-size:13px;" class="btn btn-info float-right"><i class="fas fa-plus"></i>اضافه کردن کارت</button>
    </div>
  </div>
</section>

         <!-- SIDE 2 -->
<section class="col-lg-4 connectedSortable">
            <!-- TO DO List -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                تمامی تسک های انجام نشده
              </h3>

              <div class="card-tools">
                <ul class="pagination pagination-sm">

                </ul>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <ul class="todo-list" data-widget="todo-list">
                @foreach ($task as $item)
                  <li> 
                  <form  action="{{ route('dashboard.employee.task.updatetask', $item->id) }}" method="post">
                  @csrf
                  <input type="hidden" name="id" value="{{ $item->id }}" >
                  <span class="handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div  class="icheck-primary d-inline ml-2">
                       <input type="checkbox" value="done" name="status" id="todoCheck2" onchange="this.form.submit();">
                    <label for="todoCheck2"></label>
                  </div>
                  <span class="text">{{ $item->title }}</span>
                  <small class="badge badge-info"><i class="far fa-clock"></i>{{$item->finish_date}}</small>
                  <div class="tools">

                  </div>
                </form>
                </li>                      
                
                @endforeach   
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <button type="button"  data-toggle="modal" data-target="#modal-lg" style="font-size:13px;" class="btn btn-info float-right"><i class="fas fa-plus"></i>اضافه کردن کارت</button>
            </div>
          </div>
        </section>
  </div>
    @endsection  