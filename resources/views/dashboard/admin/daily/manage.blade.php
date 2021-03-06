<?php use Hekmatinasser\Verta\Verta; ?>
@extends('layouts.dashboard')
@section('sidebar')
@include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت برنامه روزانه" route="dashboard.admin.daily.manage" />
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/MDTimePicker/mdtimepicker.min.css') }}">
    <style>
        .mdtimepicker {
            direction: ltr;
            text-align: left;
        }
    </style>
@endsection
@section('content')
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    @if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-success">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
@include('dashboard.admin.daily.create')
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
          <ul class="todo-list ui-sortable" data-widget="todo-list">
            @foreach ($task as $item)
            @if ($item->is_due_or_overdue)
            @if ($item->is_overdue)
              <li style="background:#ff7c7c">
              @else
              <li>
              @endif
              <form method="post">
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div  class="icheck-primary d-inline ml-2">
                <input type="checkbox"  id="todoCheck2{{ $item->id }}"  data-toggle="modal" data-target="#modal-success{{ $item->id }}">
                <label for="todoCheck2{{ $item->id }}"></label>
              </div>
              <span class="text" style="cursor:pointer;" data-target="#modal-info{{ $item->id }}" data-toggle="modal">{{ $item->title }}</span>
              <small class="badge badge-info"><i class="far fa-clock"></i>@if(!empty($item->start_time)){{ $item->start_time->format('H:i') }} - {{ $item->finish_time->format('H:i') }}@else {{$item->finish_date->formatJalali()}} @endif</small>
              <div class="tools">
                <script>
                  $(document).ready(function(){
                $(".check").click(function(){
                    $("#todoCheck2{{ $item->id }}").prop("checked", true);
                });
                $(".uncheckd").click(function(){
                    $("#todoCheck2{{ $item->id }}").prop("checked", false);
                });
               });
              </script>
              </div>
            </form>
            </li>
            @endif

            <div class="modal fade show" id="modal-info{{ $item->id }}" aria-modal="true" role="dialog">
              <div class="modal-dialog modal-info">
                <div class="modal-content bg-info">
                  <div class="modal-header">
                    <h4 class="modal-title">{{ $item->title }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    {!! $item->description !!}
                  </div>
                  <div class="modal-footer justify-content-between">
                       <button type="button" class="btn btn-outline-light" data-dismiss="modal">بستن</button>
                  </form>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

                <!-- SHOW SUCCESS modal -->
                <div class="modal fade show" id="modal-success{{ $item->id }}" aria-modal="true" role="dialog">
                  <div class="modal-dialog modal-success">
                    <div class="modal-content bg-success">
                      <div class="modal-header">
                        <h4 class="modal-title">{{ $item->title }}</h4>
                        <button type="button" class="close uncheckd" data-dismiss="modal" aria-label="Close">
                          <span  aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          آیا این مسئولیت را با موفقیت به اتمام رساندید ؟

                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light uncheckd" data-dismiss="modal">نه هنوز انجام نشده</button>
                        <form  action="{{ route('dashboard.admin.daily.updatedaily', $item->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}" >
                            <input type="hidden"  name="status" value="done">
                           <button type="submit"  class="btn btn-outline-light">بله انجام و تست شده</button>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>



            @endforeach
          </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <button type="button"  data-toggle="modal" data-target="#modal-lg" style="font-size:13px;" class="btn btn-info float-right"><i class="fas fa-plus"></i>اضافه کردن کار</button>
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
        @if($item->is_for_tomorrow)
        <li>
              <form method="post">
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <div  class="icheck-primary d-inline ml-2">
                <input type="checkbox"  id="todoCheck2{{ $item->id }}"  data-toggle="modal" data-target="#modal-success{{ $item->id }}">
                <label for="todoCheck2{{ $item->id }}"></label>
              </div>
              <span class="text" style="cursor:pointer;" data-target="#modal-info{{ $item->id }}" data-toggle="modal">{{ $item->title }}</span>
              <small class="badge badge-info"><i class="far fa-clock"></i>@if(!empty($item->start_time)){{ $item->start_time->format('H:i') }} - {{ $item->finish_time->format('H:i') }}@else {{$item->finish_date->formatJalali()}} @endif</small>
              <div class="tools">
                <script>
                  $(document).ready(function(){
                $(".check").click(function(){
                    $("#todoCheck2{{ $item->id }}").prop("checked", true);
                });
                $(".uncheckd").click(function(){
                    $("#todoCheck2{{ $item->id }}").prop("checked", false);
                });
               });

              </script>
              </div>
            </form>
            </li>
            @endif
            <div class="modal fade show" id="modal-info{{ $item->id }}" aria-modal="true" role="dialog">
              <div class="modal-dialog modal-info">
                <div class="modal-content bg-info">
                  <div class="modal-header">
                    <h4 class="modal-title">{{ $item->title }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    {!! $item->description !!}
                  </div>
                  <div class="modal-footer justify-content-between">
                       <button type="button" class="btn btn-outline-light" data-dismiss="modal">بستن</button>
                  </form>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>

                <!-- SHOW SUCCESS modal -->
                <div class="modal fade show" id="modal-success{{ $item->id }}" aria-modal="true" role="dialog">
                  <div class="modal-dialog modal-success">
                    <div class="modal-content bg-success">
                      <div class="modal-header">
                        <h4 class="modal-title">{{ $item->title }}</h4>
                        <button type="button" class="close uncheckd" data-dismiss="modal" aria-label="Close">
                          <span  aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          آیا این مسئولیت را با موفقیت به اتمام رساندید ؟

                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light uncheckd" data-dismiss="modal">نه هنوز انجام نشده</button>
                        <form  action="{{ route('dashboard.admin.daily.updatedaily', $item->id) }}" method="post">
                          @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}" >
                            <input type="hidden"  name="status" value="done">
                           <button type="submit"  class="btn btn-outline-light">بله انجام و تست شده</button>
                        </form>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

        @endforeach
      </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
              <button type="button"  data-toggle="modal" data-target="#modal-lg" style="font-size:13px;" class="btn btn-info float-right"><i class="fas fa-plus"></i>اضافه کردن کار</button>
    </div>
  </div>
</section>

     <!-- SIDE 3 -->
      <section class="col-lg-4 connectedSortable">
            <!-- TO DO List -->
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                تمامی مسئولیت های انجام نشده
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
                  @if(!$item->is_done)
                  <li>
                  <form  method="post">
                  <span class="handle">
                    <i class="fas fa-ellipsis-v"></i>
                    <i class="fas fa-ellipsis-v"></i>
                  </span>
                  <div  class="icheck-primary d-inline ml-2">
                       <input type="checkbox"  id="todoCheck2{{ $item->id }}"  data-toggle="modal" data-target="#modal-success{{ $item->id }}">
                    <label for="todoCheck2{{ $item->id }}"></label>
                  </div>
                  <span class="text" style="cursor:pointer;" data-target="#modal-info{{ $item->id }}" data-toggle="modal">{{ $item->title }}</span>
                  <small class="badge badge-info"><i class="far fa-clock"></i>@if(!empty($item->start_time)){{ $item->start_time->format('H:i') }} - {{ $item->finish_time->format('H:i') }}@else {{$item->finish_date->formatJalali()}} @endif</small>
                  <div class="tools">
                    <script>
                      $(document).ready(function(){
                    $(".check").click(function(){
                        $("#todoCheck2{{ $item->id }}").prop("checked", true);
                    });
                    $(".uncheckd").click(function(){
                        $("#todoCheck2{{ $item->id }}").prop("checked", false);
                    });
                   });

                  </script>
                  </div>

                </li>
                <!-- SHOW INFO modal -->
                <div class="modal fade show" id="modal-info{{ $item->id }}" aria-modal="true" role="dialog">
                  <div class="modal-dialog modal-info">
                    <div class="modal-content bg-info">
                      <div class="modal-header">
                        <h4 class="modal-title">{{ $item->title }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        {!! $item->description !!}

                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">بستن</button>

                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

               <!-- SHOW SUCCESS modal -->
               <div class="modal fade show" id="modal-success{{ $item->id }}" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-success">
                  <div class="modal-content bg-success">
                    <div class="modal-header">
                      <h4 class="modal-title">{{ $item->title }}</h4>
                      <button type="button" class="close uncheckd" data-dismiss="modal" aria-label="Close">
                        <span  aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        آیا این مسئولیت را با موفقیت به اتمام رساندید ؟

                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-outline-light uncheckd" data-dismiss="modal">نه هنوز انجام نشده</button>
                      <form  action="{{ route('dashboard.admin.daily.updatedaily', $item->id) }}" method="post">
                        @csrf
                           <input type="hidden" name="id" value="{{ $item->id }}" >
                           <input type="hidden"  name="status" value="done">
                          <button type="submit"  class="btn btn-outline-light">بله انجام و تست شده</button>
                       </form>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>


                      @endif
                @endforeach
              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <button type="button"  data-toggle="modal" data-target="#modal-lg" style="font-size:13px;" class="btn btn-info float-right"><i class="fas fa-plus"></i>اضافه کردن کار</button>
            </div>
          </div>
        </section>
  </div>
    @endsection
@section('scripts')
    <script src="{{ asset('assets/dashboard/plugins/MDTimePicker/mdtimepicker.min.js') }}"></script>
    <script>
        mdtimepicker('.mdtimepicker-input', {
            is24hour: true,
        });
    </script>
@endsection
