@foreach ($posts as $post)
<form action="{{ route('dashboard.admin.employee.updateemployee', $post->id) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade show" id="modal-edit-employee-{{ $post->id }}" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ویرایش کاربر پروژه {{ $post->project->title }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-card type="info">
                        <x-card-header>ویرایش کاربر پروژه {{ $post->project->title }}</x-card-header>
                        <x-card-body>
                            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="id" value="{{ $post->id }}" >
                            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="project_id" value="{{ $post->project->id }}" >
                            <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="employee_id" value="{{ $post->for->id }}" >
                            <x-select-group name="salary_id" label="دستمزد" :model="$post">
                                <x-select-item value=""></x-select-item>
                                @foreach($salaries as $item)
                                    <x-select-item :value="$item->id">{{ $item->title }} ({{ $item->amount }})</x-select-item>
                                @endforeach
                            </x-select-group>
                            <div class="form-group">
                                <label>تاریخ شروع:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                  </div>
                                  <input id="date" name="start_date" type="text" value="{{ $post->start_date->formatJalali() }}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label>تاریخ پایان:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                  </div>
                                  <input id="date1" name="finish_date" value="{{ $post->finish_date->formatJalali() }}" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </x-card-body>
                    </x-card>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <button type="submit"  class="btn btn-primary toastrDefaultInfo">ثبت</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</form>
@endforeach
