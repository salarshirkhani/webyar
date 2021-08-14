@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.employee.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.employee.index" />
    <x-breadcrumb-item title="پیام ها " route="dashboard.employee.message.manage" />
    <x-breadcrumb-item title="اطلاعات پیام" route="dashboard.employee.message.show" />
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
            <x-card-header>اطلاعات پیام </x-card-header>
            <div style="margin:15px">
              <h3 style="">{{$message->title}} </h3>
            <br>
            متن پیام:  {{$message->content}}
            </div>
             <x-card-footer>
           <p style="color:rgb(117, 115, 115)">      تاریخ ارسال : {!! Facades\Verta::instance($message->created_at)->formatDate() !!} </p>
             </x-card-footer>
            </form>
    </x-card>
    </div>
    @endsection