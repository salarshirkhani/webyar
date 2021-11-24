@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.admin.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.admin.index"/>
    <x-breadcrumb-item title="افزودن تاریخ تعطیلی" route="dashboard.admin.date.create"/>
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
            <x-card-header>ساخت تاریخ تعطیلی جدید</x-card-header>
            <form style="padding:10px;" action="{{ route('dashboard.admin.date.create') }}" method="post"
                  role="form" class="form-horizontal " enctype="multipart/form-data">
                 <div class="form-group">
                    <label>جدول تاریخ</label>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>مقدار</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody id="specs">
                            <?php $number=0 ?>
                        @if(old('specifications'))
                            @foreach(old('specifications') as $idx => $specification)
                                @if(!empty($specification['date'])))
                                    @include('dashboard.admin.date.spec-item', [
                                        'idx' => $idx,
                                        'date' => $specification['date'],
                                    ])
                                @endif
                            @endforeach
                        @elseif(!empty($model))
                            @foreach($model->specifications as $specification)
                                @include('dashboard.admin.date.spec-item', ['specification' => $specification])\
                             
                            @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                        <td colspan="3">
                            <script>
                                $(function () {

});
                  </script>{{$number}}
                            <button id="add-spec" type="button" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></button>
                        </td>
                        </tr>
                        </tfoot>
                    </table>
                 </div>
                {{ csrf_field() }}
                <x-card-footer>
                    <button type="submit" style=" margin: 20px 0px; height: 42px;width: 100%;font-size: 20px;"
                            class="btn btn-primary">ارسال
                    </button>
                </x-card-footer>
            </form>
        </x-card>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let field = `@include('dashboard.admin.date.spec-item', ['specification' => null])`;
            let idx = $("#specs tr").length + 1;
            $('#add-spec').click(function () {
                $("#specs").append(field.replace(/IDX/g, idx.toString()));
                updateListeners();
                idx ++;
                $("#date2").persianDatepicker({
   onSelect: updateContinuityIsEnabled,
});
            });
  
            function onRemove() {
                $(this).closest('tr').remove();
            }
            function updateListeners() {
                $('.btn-remove-spec').click(onRemove);
            }

        });
        document.write(idx); 
    </script>
    {{ !empty($specification) ? $idx : 'IDX' }}
@endsection
