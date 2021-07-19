@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="مدیریت پروژه ها" route="dashboard.admin.project.manage" />
    <x-breadcrumb-item title="{{ $post->title }}" route="dashboard.admin.project.index" />   
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
            <x-card-header>{{ $post->title }}</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        {{ $post->description }}
                        <div style="margin-bottom: 50px;"></div>
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">فاز بندی پروژه</h3>
                            </div>
                        <div class="card-body p-0">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>تسک ها</th>
                                <th>حذف</th>                               
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($phase as $item)
                             <?php $ids=$item->id ; ?> 
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{!! Facades\Verta::instance($item->start_date)->formatDate() !!}</td>
                                    <td>{!! Facades\Verta::instance($item->finish_date)->formatDate() !!}</td>
                                    <td><button type="button" class="btn btn-block bg-gradient-warning btn-sm">مدیرت تسک ها</button></td>
                                    <td>
                                    <a href="{{route('dashboard.admin.phase.deletephase',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>                 
                                    </td>
                                    <td>
                                    <a href="{{route('dashboard.admin.phase.updatephase',['id'=>$item->id])}}" class="edit_post" target="_blank"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>عنوان</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ پایان</th>
                                    <th>تسک ها</th>
                                    <th>حذف</th>                               
                                    <th>ویرایش</th>
                                </tr>
                                </tfoot>
                        </table>
                       </div>
                       <a href="{{route('dashboard.admin.phase.create',['id'=>$id])}}" class="btn btn-success">ثبت فاز جدید برای پروژه</a>
                    </div>
                       <div style="margin-bottom: 50px;"></div>
                       <div class="card">
                           <div class="card-header">
                             <h3 class="card-title">کاربران این پروژه</h3>
                           </div>
                       <div class="card-body p-0">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>تاریخ شروع</th>
                                <th>تاریخ پایان</th>
                                <th>تسک ها</th>
                                <th>حذف</th>                               
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($phase as $item)
                             <?php $ids=$item->id ; ?> 
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{!! Facades\Verta::instance($item->start_date)->formatDate() !!}</td>
                                    <td>{!! Facades\Verta::instance($item->finish_date)->formatDate() !!}</td>
                                    <td><button type="button" class="btn btn-block bg-gradient-warning btn-sm">مدیرت تسک ها</button></td>
                                    <td>
                                    <a href="{{route('dashboard.admin.phase.deletephase',['id'=>$item->id])}}" class="delete_post" ><i class="fa fa-fw fa-eraser"></i></a>                 
                                    </td>
                                    <td>
                                    <a href="{{route('dashboard.admin.phase.updatephase',['id'=>$item->id])}}" class="edit_post" target="_blank"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>عنوان</th>
                                    <th>تاریخ شروع</th>
                                    <th>تاریخ پایان</th>
                                    <th>تسک ها</th>
                                    <th>حذف</th>                               
                                    <th>ویرایش</th>
                                </tr>
                                </tfoot>
                        </table>
                        </div>
                        <a href="{{route('dashboard.admin.phase.create',['id'=>$id])}}" class="btn btn-success">ثبت کاربر جدید برای پروژه</a>
                       
                        <!-- /.card-body -->
                        </div>
                    </div>
                    </x-card-body>
                <x-card-footer>
                </x-card-footer>      
        </x-card>
    </div>
    @endsection