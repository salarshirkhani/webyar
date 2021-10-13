<div class="modal fade show" id="modal-create-employee" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ساخت فاز جدید</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <x-card type="info">
                    <x-card-header>افزودن کاربران به پروژه</x-card-header>
                    <x-card-body>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>نام و نام خانوادگی</th>
                                <th>ایمیل</th>
                                <th>شماره تماس</th>
                                <th>پروفایل</th>
                                <th>اضافه کردن به پروژه</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $item)
                                <?php $ids = $item->id; ?>
                                <tr>
                                    <td>{{ $item->first_name }} {{ $item->last_name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->mobile }}</td>
                                    <td>
                                        <a target="_blank" href="{{ route('dashboard.admin.users.profile',['id'=>$item->id]) }}" class="btn btn-block btn-outline-primary btn-sm">
                                            مشاهده پروفایل
                                        </a>
                                    </td>
                                    <td>
                                        <form style="padding:10px;"
                                              action="{{ route('dashboard.admin.employee.create',['id'=>$id]) }}"
                                              method="post" role="form" class="form-horizontal "
                                              enctype="multipart/form-data">
                                            <input type="hidden"
                                                   style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                                                   class="form-control" name="project_id" value="{{ $id }}">
                                            <input type="hidden"
                                                   style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                                                   class="form-control" name="employee_id" value="{{ $item->id }}">
                                            <input type="hidden"
                                                   style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                                                   class="form-control" name="start_date"
                                                   value="{{ $project->start_date->formatJalali() }}">
                                            <input type="hidden"
                                                   style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                                                   class="form-control" name="finish_date"
                                                   value="{{ $project->finish_date->formatJalali()  }}">
                                            <input type="hidden"
                                                   style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"
                                                   class="form-control" name="cost" value="0">
                                            @csrf
                                            <button type="submit" class="btn btn-block bg-gradient-success btn-sm">
                                                افزودن به پروژه
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>نام و نام خانوادگی</th>
                                <th>ایمیل</th>
                                <th>شماره تماس</th>
                                <th>پروفایل</th>
                                <th>اضافه کردن به پروژه</th>
                            </tr>
                            </tfoot>
                        </table>
                    </x-card-body>
                </x-card>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
