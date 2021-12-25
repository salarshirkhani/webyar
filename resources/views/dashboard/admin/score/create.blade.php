@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="افزودن/کسر امتیاز" route="dashboard.admin.score.create"/>
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
            <x-card-header>افزودن/کسر امتیاز</x-card-header>
            <form style="padding:10px;" action="{{ route('dashboard.admin.score.store') }}"
                  method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
                @csrf
                <x-card-body>
                    <div class="form-group">
                        <label>کاربر</label><br>
                        @foreach($users as $user)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="user_id" value="{{ $user->id }}" id="check_{{ $user->id }}">
                                <label class="form-check-label" for="check_{{ $user->id }}">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    <x-text-group name="description_no_textarea" label="توضیحات" />
                    <x-text-group name="value" label="مقدار" type="number" step="any" />
                </x-card-body>
                <x-card-footer>
                    <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"
                            class="btn btn-primary">ارسال
                    </button>
                </x-card-footer>
            </form>
        </x-card>
    </div>
@endsection
