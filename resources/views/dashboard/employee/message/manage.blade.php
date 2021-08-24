@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.employee.notification')
    @include('dashboard.employee.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.employee.index" />
    <x-breadcrumb-item title="مدیریت پیام ها" route="dashboard.employee.message.manage" />
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
            <x-card-header>مدیریت پیام ها</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <div style="margin-bottom: 50px;"></div>
                        <div class="card">
                            <div class="card-header">
                              <h3 class="card-title">پیام های ارسالی</h3>
                            </div>
                        <div class="card-body p-0">
                        <table id="example" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>ارسال به</th>
                                <th>موضوع</th>
                                <th>تاریخ</th>
                                <th>وضعیت پیام</th>
                                <th>مشاهده </th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($message as $item)
                                <tr>
                                    <td>{{ $item->for->first_name }} {{ $item->for->last_name }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{!! $item->created_at->formatJalali() !!}</td>
                                    <td>
                                        @if ($item->status=='seen')
                                          <p style="color:green;"> خوانده شده </p>
                                        @else
                                          <p style="color:red;">خوانده نشده</p>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('dashboard.employee.message.show',['id'=>$item->id])}}" class="btn btn-block btn-outline-primary btn-sm">مشاهده پیام</a>
                                        @if(!$item->answer_id)
                                            <a href="{{route('dashboard.employee.message.answer',['message'=>$item])}}" class="btn btn-block btn-outline-success btn-sm">ارسال پاسخ</a>
                                        @endif
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ارسال به</th>
                                    <th>موضوع</th>
                                    <th>تاریخ</th>
                                    <th>وضعیت پیام</th>
                                    <th>مشاهده </th>
                                </tr>
                                </tfoot>
                        </table>
                       </div>
                    </div>

                    </div>
                    </x-card-body>
                <x-card-footer>
                </x-card-footer>
        </x-card>
    </div>

    @endsection

