@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.customer.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.customer.index"/>
    <x-breadcrumb-item title="مشاهده درخواست پشتیبانی" route="dashboard.customer.ticket.show"/>
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
        <x-card>
            <x-card-header>مشاهده درخواست‌ پشتیبانی</x-card-header>
            <x-card-body>
                @foreach($ticket->messages as $message)
                    <x-card type="primary">
                        <x-card-header>{{ $message->user->first_name }} {{ $message->user->last_name }} <span
                                class="float-right text-sm">{{ $message->created_at->formatJalali('H:i Y/n/j') }}</span>
                        </x-card-header>
                        <x-card-body>
                            {!! $message->content !!}
                        </x-card-body>
                        @if(!empty($message->file))
                            <x-card-footer class="bg-white">
                                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                    <li>
                                        <div class="mailbox-attachment-info">
                                            <a href="{{ Storage::url($message->file) }}" class="mailbox-attachment-name">
                                                <i class="fas fa-paperclip"></i>فایل پیوست
                                            </a>
                                            <span class="mailbox-attachment-size clearfix mt-1">
                                                <span>{{ formatBytes(Storage::disk('public')->size($message->file)) }}</span>
                                                <a href="{{ Storage::url($message->file) }}" class="btn btn-default btn-sm float-right">
                                                    <i class="fas fa-cloud-download-alt"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </x-card-footer>
                        @endif
                    </x-card>
                @endforeach
            </x-card-body>
            <x-card-footer>
                <a href="{{ route('dashboard.customer.ticket.edit', compact('ticket')) }}" class="btn btn-success">ارسال پاسخ</a>
            </x-card-footer>
        </x-card>
    </div>
@endsection
