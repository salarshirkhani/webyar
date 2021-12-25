@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="لیست امتیازات" route="dashboard.admin.score.index"/>
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
            <x-card-header>لیست امتیازات</x-card-header>
            <x-card-body>
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>مقدار</th>
                        <th>کاربر</th>
                        <th>توضیحات</th>
                        <th>ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($scores as $item)
                        <tr>
                            <td>{{ $item->value }}</td>
                            <td>@empty($item->user) کاربر حذف شده @else {{ $item->user->first_name }} {{ $item->user->last_name }}@endempty</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <form action="{{ route('dashboard.admin.score.destroy', ['score' => $item]) }}" method="post">
                                    @method("DELETE")
                                    @csrf
                                    <a href="{{route('dashboard.admin.score.edit',['score'=>$item])}}" class="edit_post"
                                        target="_blank"><i class="fas fa-edit"></i></a>
                                    <button style="color: #dc3545; background: none; border: none; display: inline" type="submit" class="edit_post"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>مقدار</th>
                        <th>کاربر</th>
                        <th>توضیحات</th>
                        <th>ویرایش</th>
                    </tr>
                    </tfoot>
                </table>
            </x-card-body>
            <x-card-footer>
                <a href="{{ route('dashboard.admin.score.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> افزودن/کسر امتیاز به کاربر</a>
            </x-card-footer>
        </x-card>
    </div>
@endsection
