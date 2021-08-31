@extends('layouts.auth')

@section('content')
    @if ($errors->any() || session('status'))
        <div class="wrap-messages">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <div class="login100-pic">
        <img style="display:block ; margin-right:auto; margin-left:auto;" src="{{ asset("assets/images/logo.png") }}" alt="IMG">
    </div>

    <form class="login100-form validate-form" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <span class="login100-form-title">
            تعیین رمز جدید
					</span>

        <div class="wrap-input100 validate-input" data-validate="ایمیل اجباری است!">
            <input type="email" name="email" maxlength="100" class=" input100" placeholder="ایمیل" required=""
                   id="id_email" value="{{ $email ?? old('email') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="رمزعبور اجباری است!">
            <input type="password" name="password" class=" input100" placeholder="کلمه‌عبور" id="id_password">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
			    <i class="fa fa-lock" aria-hidden="true"></i>
			</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="تکرار رمزعبور اجباری است!">
            <input type="password" name="password_confirmation" class=" input100" placeholder="تکرار کلمه‌عبور" id="id_password_confirmation">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
			    <i class="fa fa-lock" aria-hidden="true"></i>
			</span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn">
                تغییر رمز
            </button>
        </div>

        <div class="text-center p-t-136">
            <a class="txt2" href="{{ route('login') }}">
                {{ __('میخواهید وارد شوید؟') }}
                <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
            </a>
            <br>
            <a class="txt2" href="javascript:history.back()">
                {{ __('بازگشت') }}
                <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
@endsection
