@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="ارسال پاسخ" route="dashboard.admin.ticket.edit"/>
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
            <form style="padding:10px;" action="{{ route('dashboard.admin.ticket.update', compact('ticket')) }}" method="post"
                  role="form" class="form-horizontal " enctype="multipart/form-data">
                <x-card-header>ارسال پاسخ</x-card-header>
                @csrf
                @method('PUT')
                <x-card-body>
                    <x-textarea-group required id="description" name="content" label="پیام"></x-textarea-group>
                    <x-file-group name="file" label="پیوست" />
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
