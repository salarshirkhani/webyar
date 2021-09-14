@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.' . \Auth::user()->type . '.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.index" />
    <x-breadcrumb-item title="ویرایش پروفایل" route="dashboard.profile.edit" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
        <form role="form" method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-card type="primary">
                <x-card-header>پروفایل کاربری</x-card-header>
                <x-card-body>
                    <x-text-group name="first_name" label="نام" :model="Auth::user()" />
                    <x-text-group name="last_name" label="نام خانوادگی" :model="Auth::user()" />
                    <x-text-group name="birthdate" label="سال تولد" :model="Auth::user()" />
                    <x-text-group name="email" label="ایمیل" type="email" :model="Auth::user()" disabled />
                    <x-text-group name="mobile" label="موبایل" type="tel" :model="Auth::user()" />
                    <x-text-group name="situation" label="سمت" :model="Auth::user()" />
                    <x-file-group name="picture" label="تصویر پروفایل" accept=".jpg,.jpeg,.png" :model="Auth::user()" />
                    @if(!empty(Auth::user()->picture))
                        <div class="form-group row" style="text-align: left">
                            <div class="col-md-3" style="text-align: right">تصویر فعلی</div>
                            <div class="col-md-9"><img style="max-width: 100px; width: 100%" src="{{ Storage::url(Auth::user()->picture) }}"></div>
                        </div>
                    @endif
                    <x-text-group name="password" label="رمزعبور (در صورت عدم تغییر خالی بگذارید)" type="password" />
                    <x-text-group name="password_confirmation" label="تایید رمزعبور (در صورت عدم تغییر خالی بگذارید)" type="password" />
                </x-card-body>
                <x-card-footer>
                    <button type="submit" class="btn btn-primary">ثبت</button>
                </x-card-footer>
            </x-card>
        </form>
    </div>
@endsection
