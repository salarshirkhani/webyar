@extends('layouts.auth')

@section('content')
    @if ($errors->any())
        <div class="wrap-messages">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="login100-pic">
        <img style="display:block ; margin-right:auto; margin-left:auto;" src="{{ asset("assets/images/logo.png") }}" alt="IMG">
    </div>


    <form class="login100-form validate-form" action="{{ route('register') }}" method="POST">
        @csrf
        <span class="login100-form-title">
						خوش آمدید :)
					</span>

        <div class="wrap-input100 validate-input" data-validate="نام اجباری است!">
            <input type="text" name="first_name" maxlength="100" class=" input100" placeholder="نام" required=""
                   id="id_first_name" value="{{ old('first_name') ?? '' }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="نام‌خانوادگی اجباری است!">
            <input type="text" name="last_name" maxlength="100" class=" input100" placeholder="نام خانوادگی" required=""
                   id="id_last_name" value="{{ old('last_name') ?? '' }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="تاریخ تولد اجباری است!">
            <input type="text" name="birthdate" maxlength="100" class=" input100" placeholder="تاریخ تولد"
                   id="id_birthdate" value="{{ old('birthdate') ?? '' }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="سمت را وارد کنید">
            <input type="text" name="situation" maxlength="100" class=" input100" placeholder="سمت"
                   id="id_situation" value="{{ old('situation') ?? '' }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="موبایل صحیح نیست!">
            <input type="tel" name="mobile" class=" input100" placeholder="موبایل" required=""
                   id="id_mobile" value="{{ old('mobile') ?? '' }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="ایمیل صحیح نیست!">
            <input type="email" name="email" class=" input100" placeholder="ایمیل" required=""
                   id="id_email" value="{{ old('email') ?? '' }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="رمزعبور اجباری است!">
            <input type="password" name="password" class=" input100" placeholder="کلمه‌عبور" id="id_password"
                   style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAABKRJREFUWAnNl0tsVGUUxzvTTlslZUaCloZHY6BRFkp9sDBuqgINpaBp02dIDImwKDG6ICQ8jBYlhg0rxUBYEALTpulMgBlqOqHRDSikJkZdGG0CRqAGUuwDovQ1/s7NPTffnTu3zMxGvuT2vP7n8Z3vu+dOi4r+5xUoJH8sFquamZmpTqfTVeIfCARGQ6HQH83NzaP5xsu5gL6+vuVzc3NdJN1Kkhd8Ev1MMYni4uJjra2tt3wwLvUjCxgYGFg8Pj7+MV5dPOUub3/hX0zHIpFId0NDw6Q/jO4tZOzv76+Znp6+AOb5TBw7/YduWC2Hr4J/IhOD/GswGHy7vb39tyw2S+VbAC1/ZXZ29hKoiOE8RrIvaPE5WvyjoS8CX8sRvYPufYpZYtjGS0pKNoD/wdA5bNYCCLaMYMMEWq5IEn8ZDof3P6ql9pF9jp8cma6bFLGeIv5ShdISZUzKzqPIVnISp3l20caTJsaPtwvc3dPTIx06ziZkkyvY0FnoW5l+ng7guAWnpAI5w4MkP6yy0GQy+dTU1JToGm19sqKi4kBjY+PftmwRYn1ErEOq4+i2tLW1DagsNGgKNv+p6tj595nJxUbyOIF38AwipoSfnJyMqZ9SfD8jxlWV5+fnu5VX6iqgt7d3NcFeUiN0n8FbLEOoGkwdgY90dnbu7OjoeE94jG9wd1aZePRp5AOqw+9VMM+qLNRVABXKkLEWzn8S/FtbdAhnuVQE7LdVafBPq04pMYawO0OJ+6XHZkFcBQA0J1xKgyhlB0EChEWGX8RulsgjvOjEBu+5V+icWOSoFawuVwEordluG28oSCmXSs55SGSCHiXhmDzC25ghMHGbdwhJr6sAdpnyQl0FYIyoEX5CeYOuNHg/NhvGiUUxVgfV2VUAxjtqgPecp9oKoE4sNnbX9HcVgMH8nD5nAoWnKM/5ZmKyySRdq3pCmDncR4DxOwVC64eHh0OGLOcur1Vey46xUZ3IcVl5oa4OlJaWXgQwJwZyhUdGRjqE14VtSnk/mokhxnawiwUvsZmsX5u+rgKamprGMDoA5sKhRCLxpDowSpsJ8vpCj2AUPzg4uIiNfKIyNMkH6Z4hF3k+RgTYz6vVAEiKq2bsniZIC0nTtvMVMwBzoBT9tKkTHp8Ak1V8dTrOE+NgJs7VATESTH5WnVAgfHUqlXK6oHpJEI1G9zEZH/Du16leqHyS0UXBNKmeOMf5NvyislJPB8RAFz4g8IuwofLy8k319fUP1EEouw7L7mC3kUTO1nn3sb02MTFxFpsz87FfJuaH4pu5fF+reDz+DEfxkI44Q0ScSbyOpDGe1RqMBN08o+ha0L0JdeKi/6msrGwj98uZMeon1AGaSj+elr9LwK9IkO33n8cN7Hl2vp1N3PcYbUXOBbDz9bwV1/wCmXoS3+B128OPD/l2LLg8l9APXVlZKZfzfDY7ehlQv0PPQDez6zW5JJdYOXdAwHK2dGIv7GH4YtHJIvEOvvunLCHPPzl3QOLKTkl0hPbKaDUvlTU988xtwfMqQBPQ3m/4mf0yBVlDCSr/CRW0CipAMnGzb9XU1NSRvIX7kSgo++Pg9B8wltxxbHKPZgAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: left center;">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
        </div>

        <div class="wrap-input100 validate-input" data-validate="تکرار رمزعبور اجباری است!">
            <input type="password" name="password_confirmation" class=" input100" placeholder="تکرار کلمه‌عبور"
                   id="id_password_confirmation"
                   style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAAAXNSR0IArs4c6QAABKRJREFUWAnNl0tsVGUUxzvTTlslZUaCloZHY6BRFkp9sDBuqgINpaBp02dIDImwKDG6ICQ8jBYlhg0rxUBYEALTpulMgBlqOqHRDSikJkZdGG0CRqAGUuwDovQ1/s7NPTffnTu3zMxGvuT2vP7n8Z3vu+dOi4r+5xUoJH8sFquamZmpTqfTVeIfCARGQ6HQH83NzaP5xsu5gL6+vuVzc3NdJN1Kkhd8Ev1MMYni4uJjra2tt3wwLvUjCxgYGFg8Pj7+MV5dPOUub3/hX0zHIpFId0NDw6Q/jO4tZOzv76+Znp6+AOb5TBw7/YduWC2Hr4J/IhOD/GswGHy7vb39tyw2S+VbAC1/ZXZ29hKoiOE8RrIvaPE5WvyjoS8CX8sRvYPufYpZYtjGS0pKNoD/wdA5bNYCCLaMYMMEWq5IEn8ZDof3P6ql9pF9jp8cma6bFLGeIv5ShdISZUzKzqPIVnISp3l20caTJsaPtwvc3dPTIx06ziZkkyvY0FnoW5l+ng7guAWnpAI5w4MkP6yy0GQy+dTU1JToGm19sqKi4kBjY+PftmwRYn1ErEOq4+i2tLW1DagsNGgKNv+p6tj595nJxUbyOIF38AwipoSfnJyMqZ9SfD8jxlWV5+fnu5VX6iqgt7d3NcFeUiN0n8FbLEOoGkwdgY90dnbu7OjoeE94jG9wd1aZePRp5AOqw+9VMM+qLNRVABXKkLEWzn8S/FtbdAhnuVQE7LdVafBPq04pMYawO0OJ+6XHZkFcBQA0J1xKgyhlB0EChEWGX8RulsgjvOjEBu+5V+icWOSoFawuVwEordluG28oSCmXSs55SGSCHiXhmDzC25ghMHGbdwhJr6sAdpnyQl0FYIyoEX5CeYOuNHg/NhvGiUUxVgfV2VUAxjtqgPecp9oKoE4sNnbX9HcVgMH8nD5nAoWnKM/5ZmKyySRdq3pCmDncR4DxOwVC64eHh0OGLOcur1Vey46xUZ3IcVl5oa4OlJaWXgQwJwZyhUdGRjqE14VtSnk/mokhxnawiwUvsZmsX5u+rgKamprGMDoA5sKhRCLxpDowSpsJ8vpCj2AUPzg4uIiNfKIyNMkH6Z4hF3k+RgTYz6vVAEiKq2bsniZIC0nTtvMVMwBzoBT9tKkTHp8Ak1V8dTrOE+NgJs7VATESTH5WnVAgfHUqlXK6oHpJEI1G9zEZH/Du16leqHyS0UXBNKmeOMf5NvyislJPB8RAFz4g8IuwofLy8k319fUP1EEouw7L7mC3kUTO1nn3sb02MTFxFpsz87FfJuaH4pu5fF+reDz+DEfxkI44Q0ScSbyOpDGe1RqMBN08o+ha0L0JdeKi/6msrGwj98uZMeon1AGaSj+elr9LwK9IkO33n8cN7Hl2vp1N3PcYbUXOBbDz9bwV1/wCmXoS3+B128OPD/l2LLg8l9APXVlZKZfzfDY7ehlQv0PPQDez6zW5JJdYOXdAwHK2dGIv7GH4YtHJIvEOvvunLCHPPzl3QOLKTkl0hPbKaDUvlTU988xtwfMqQBPQ3m/4mf0yBVlDCSr/CRW0CipAMnGzb9XU1NSRvIX7kSgo++Pg9B8wltxxbHKPZgAAAABJRU5ErkJggg==&quot;); background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: left center;">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
        </div>

        <div class="container-login100-form-btn">
            <button class="login100-form-btn" name="type" value="employee">
                ثبت‌نام به عنوان همکار
            </button>
            <button class="login100-form-btn" name="type" value="customer" style="margin-top: 8px">
                ثبت‌نام به عنوان مشتری
            </button>
        </div>

{{--        <div class="text-center p-t-12">--}}
{{--            <a class="txt2" href="#">--}}
{{--                رمزعبور خود--}}
{{--            </a>--}}
{{--            <span class="txt1">--}}
{{--							را فراموش کرده‌اید؟--}}
{{--						</span>--}}
{{--        </div>--}}

        <div class="text-center p-t-24">
            <a class="txt2" href="{{ route('login') }}">
                حساب کاربری دارید؟
                <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
            </a>
            <br>
            <a class="txt2" href="javascript:history.back()">
                بازگشت
                <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
            </a>
        </div>
    </form>
@endsection
