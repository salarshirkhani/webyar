@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="پیام ها " route="dashboard.admin.message.manage" />
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/dashboard/plugins/dropzone/min/dropzone.min.css') }}">
    <script src="{{ asset('assets/dashboard/plugins/dropzone/min/dropzone.min.js') }}"></script>
@if(Session::has('info'))
    <div class="row">
        <div class="col-md-12">
            <p class="alert alert-info">{{ Session::get('info') }}</p>
        </div>
    </div>
@endif
    <div class="col-md-12">
        <x-card type="info">
            <x-card-header>ویرایش پیام</x-card-header>
        <form style="padding:10px;" action="{{ route('dashboard.admin.message.updatemessage',['id'=>$post->id]) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $post->id }}" >
            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title" value="{{$post->title}}" placeholder="عنوان">
            <x-select-group name="user_id" label="ارسال به" required :model="$model ?? null">
                <x-select-item :value="$post->user_id">{{$post->for->first_name}} {{$post->for->last_name }}</x-select-item>
                @foreach($users as $user)
                    <x-select-item :value="$user->id">{{ $user->first_name }} {{ $user->last_name }}</x-select-item>
                @endforeach
            </x-select-group>
            <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" required name="content"  placeholder="متن پیام">{{$post->content}}</textarea>
            <input type="file" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; width: 100%; font-size: 16px;" class="dropzone" required name="file">
            <script type="text/javascript">
                Dropzone.options.dropzone =
                    {
                        maxFilesize: 12,
                        renameFile: function(file) {
                            var dt = new Date();
                            var time = dt.getTime();
                            return time+file.name;
                        },
                        acceptedFiles: ".jpeg,.jpg,.png,.gif,.docx,.pdf,.mp4,.mp3,.3gp,.xlxx,.txt",
                       success: function(file, response)
                        {
                            console.log(response);
                        },
                             addRemoveLinks: true,
                        timeout: 500000,
                    error: function(file, response)
                        {
                            return 1;
                        }
                    };
                </script>
            {{ csrf_field() }}
             <x-card-footer>
                <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"  class="btn btn-primary">ارسال</button>
             </x-card-footer>
            </form>
    </x-card>
    </div>
    @endsection
