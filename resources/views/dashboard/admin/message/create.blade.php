@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="پیام ها " route="dashboard.admin.message.manage" />
    <x-breadcrumb-item title="ارسال پیام" route="dashboard.admin.message.create" />
@endsection
@section('content')
@if ($user_id!=NULL)
@foreach($users as $user)
<?php
if ($user_id==$user->id){
  $name=$user->first_name;  
  $lastname=$user->last_name; 
}
?>
@endforeach
@endif
@if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>ارسال پیام</x-card-header>
        <form style="padding:10px;" action="{{ route('dashboard.admin.message.create') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title"  placeholder="عنوان">            
            <x-select-group name="user_id" label="ارسال به" required :model="$model ?? null">
               @if ($user_id!=NULL)
               <x-select-item :value="$user_id"><?php echo $name.' '.$lastname; ?></x-select-item>    
               @endif
                @foreach($users as $user)
                    <x-select-item :value="$user->id">{{ $user->first_name }} {{ $user->last_name }}</x-select-item>
                @endforeach
            </x-select-group>
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" required name="content"  placeholder="متن پیام"></textarea>
            {{ csrf_field() }}
             <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
             </x-card-footer>
            </form>
    </x-card>
    </div>
    @endsection