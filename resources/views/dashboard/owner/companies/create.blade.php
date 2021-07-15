@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.owner.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.owner.index" />
    <x-breadcrumb-item title="ثبت شرکت" route="dashboard.owner.companies.create" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
        <form action="{{ route('dashboard.owner.companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <x-card type="info">
                <x-card-header>مشخصات شرکت</x-card-header>

                <x-card-body>
                    <x-text-group name="name" label="نام شرکت" required />

                    <div class="form-row">
                        <x-text-group name="province" label="استان" width="col-md-6" required />
                        <x-text-group name="city" label="شهر" width="col-md-6" required />
                        <x-textarea-group name="address" label="آدرس" rows="2" width="col-12" required />
                    </div>

                    <div class="form-row">
                        <x-text-group name="phone_number" label="تلفن ثابت" width="col-lg-4" required />
                        <x-text-group name="mobile_number" label="تلفن همراه" width="col-lg-4" />
                        <x-text-group name="fax_number" label="شماره فکس" width="col-lg-4" />
                    </div>

                    <x-select-group name="type" label="نوع شرکت" required>
                        <x-select-item/>
                        <x-select-item value="product">تولیدی</x-select-item>
                        <x-select-item value="service">خدماتی</x-select-item>
                    </x-select-group>

                    <x-text-group name="keywords" label="کلمات کلیدی" required />

                    <div class="form-row">
                        <x-text-group name="social_instagram" label="آیدی اینستاگرام" width="col-md-6" />
                        <x-text-group name="social_telegram" label="آیدی تلگرام" width="col-md-6" />
                        <x-text-group name="social_facebook" label="آیدی فیس‌بوک" width="col-md-6" />
                        <x-text-group name="social_twitter" label="آیدی توییتر" width="col-md-6" />
                    </div>

                    <x-textarea-group name="short_description" label="خلاصه فعالیت‌ها" rows="3" required />
                    <x-textarea-group name="description" label="توضیحات کامل" rows="10" />

                    <div class="form-row">
                        <x-text-group name="latitude" label="عرض جغرافیایی" width="col-md-6" required />
                        <x-text-group name="longitude" label="طول جغرافیایی" width="col-md-6" required />
                    </div>

                    <x-text-group name="website" label="آدرس وب‌سایت" />

                    <x-file-group name="logo" label="لوگوی شرکت" />
                </x-card-body>

                <x-card-footer>
                    <button type="submit" class="btn btn-success">ثبت</button>
                </x-card-footer>
            </x-card>
        </form>
    </div>
@endsection
