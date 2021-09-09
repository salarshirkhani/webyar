<div class="modal fade show" id="modal-lg" aria-modal="true" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">اضافه کردن برنامه کاری جدید</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <x-card type="info">
          <x-card-header>ساخت برنامه کاری جدید</x-card-header>
      <form style="padding:10px;" action="{{ route('dashboard.employee.task.create') }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
          <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title"  placeholder="عنوان">
          <textarea type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" required name="description"  placeholder="توضیحات مسئولیت"></textarea>
          <input type="hidden" style="margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control"  name="status" value="notwork" >
          <div class="form-group">
              <label>تاریخ شروع:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input id="date" name="start_date" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
              </div>
              <!-- /.input group -->
          </div>
          <div class="form-group">
              <label>تاریخ پایان:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input name="finish_date" type="text" id="date1" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
              </div>
              <!-- /.input group -->
          </div>
          <div class="form-group">
              <label>ساعت شروع کار:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input name="start_time" type="text" class="form-control mdtimepicker-input">
              </div>
              <!-- /.input group -->
          </div>
          <div class="form-group">
              <label>ساعت پایان کار:</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input name="finish_time" type="text" class="form-control mdtimepicker-input">
              </div>
              <!-- /.input group -->
          </div>
          <div class="form-group">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" name="ignore_conflict" id="ignore_conflict">
                  <label class="form-check-label" for="ignore_conflict">
                      صرف‌نظر کردن از تداخل زمانی
                  </label>
              </div>
          </div>
          <x-select-group label="نوع زمان‌بندی" name="continuity">
              <x-select-item value="">پیش‌فرض</x-select-item>
              <x-select-item value="1d">نمایش در هر روز</x-select-item>
              <x-select-item value="2d">نمایش یک روز در میان</x-select-item>
          </x-select-group>

            {{ csrf_field() }}
           <x-card-footer>
           </x-card-footer>

       </x-card>

      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
        <button type="submit"  class="btn btn-primary toastrDefaultInfo">اضافه کردن  برنامه کاری</button>
      </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
