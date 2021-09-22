<form action="{{ route('dashboard.admin.phase.create',['id'=>$id]) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="modal fade show" id="modal-create-phase" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ساخت فاز جدید</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <x-card type="info">
                        <x-card-header>ساخت فاز جدید</x-card-header>
                        <x-card-body>
                            <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title"  placeholder="عنوان">
                            <div class="form-group">
                                <label>تاریخ شروع:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                  </div>
                                  <input id="date" name="start_date" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" required>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label>تاریخ پایان:</label>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                  </div>
                                  <input name="finish_date" type="text" id="date1" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="" required>
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
