@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index" />
    <x-breadcrumb-item title="لیست محصولات" route="dashboard.admin.product.index" />
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
            <x-card-header>لیست محصولات</x-card-header>
                <x-card-body>
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>توضیح کوتاه</th>
                                <th>قیمت</th>
                                <th>حذف</th>
                                <th>ویرایش</th>
                            </tr>
                            </thead>
                                <tbody>
                             @foreach($products as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->short_description }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>
                                        <form method="post" action="{{ route('dashboard.admin.product.destroy', ['product' => $item]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="padding: 0;color:#dc3545" class="btn delete_post" ><i class="fa fa-fw fa-eraser"></i></button>
                                        </form>
                                    </td>
                                    <td>
                                    <a href="{{ route('dashboard.admin.product.edit', ['product' => $item]) }}" class="edit_post"><i class="fas fa-edit"></i></a>
                                    </td>
                                </tr>
                             @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>عنوان</th>
                                    <th>توضیح کوتاه</th>
                                    <th>قیمت</th>
                                    <th>حذف</th>
                                    <th>ویرایش</th>
                                </tr>
                                </tfoot>
                        </table>
                    </div>
                    </x-card-body>
                <x-card-footer>
                    <a href="{{route('dashboard.admin.product.create')}}" class="btn btn-success">ثبت محصول جدید</a>
                </x-card-footer>
        </x-card>
    </div>
    @endsection
