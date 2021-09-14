@foreach ($task as $item)
               <!-- SHOW EDIT modal -->
                <div class="modal fade show" id="modal-lf{{ $item->id }}" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">{{ $item->title }}</h4>
                          <button type="button" class="close uncheckd" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="col-md-12">
                            <x-card type="info">
                                <x-card-header>ویرایش مسئولیت </x-card-header>
                            <form style="padding:10px;" action="{{ route('dashboard.employee.task.edittask', $item->id) }}" method="post" role="form" class="form-horizontal " enctype="multipart/form-data">
                                <input type="hidden" name="id" value="{{ $item->id }}" >
                                <input type="text" style="padding:10px; margin: 10px 0px 16px 0px; height: 40px; border-radius: 7px; font-size: 16px;"class="form-control" required  name="title" value="{{ $item->title }}" placeholder="عنوان">
                                <textarea type="text" id="ckeditor{{ $item->id }}" style="padding:10px; margin: 10px 0px 16px 0px; height: 140px; border-radius: 7px; font-size: 16px;"class="form-control" name="description"  placeholder="توضیحات">{{ $item->description }}</textarea>
                                <input type="hidden" name="employee_id" value="{{ Auth::user()->id }}" >
                                <div class="form-group">
                                    <label>تاریخ شروع:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                      </div>
                                      <input id="date" name="start_date" type="text" value="{{ $item->start_date->formatJalali() }}" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>تاریخ پایان:</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                      </div>
                                      <input id="date1" name="finish_date" value="{{ $item->finish_date->formatJalali() }}" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy-mm-dd" data-mask="">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>ساعت شروع کار:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input name="start_time" value="{{ !empty($item->start_time) ? $item->start_time->format('H:i') : '' }}" type="text" class="form-control mdtimepicker-input">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group">
                                    <label>ساعت پایان کار:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input name="finish_time" value="{{ !empty($item->finish_time) ? $item->finish_time->format('H:i') : '' }}" type="text" class="form-control mdtimepicker-input">
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
                                <x-select-group name="status" label="وضعیت" :model="$item ?? null">
                                  <x-select-item value="notwork">انجام نشده</x-select-item>
                                  <x-select-item value="done">انجام شده</x-select-item>
                                </x-select-group>
                                <x-select-group label="نوع زمان‌بندی" name="continuity" :model="$item ?? null" :class="$item->start_date->isSameDay($item->finish_date) ? 'should_disable' : ''">
                                    <x-select-item value="">پیش‌فرض</x-select-item>
                                    <x-select-item value="1d">نمایش در هر روز</x-select-item>
                                    <x-select-item value="2d">نمایش یک روز در میان</x-select-item>
                                </x-select-group>
                                 {{ csrf_field() }}
                        </x-card>
                        </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-outline" data-dismiss="modal">بستن</button>
                          <button type="submit"  type="submit"  class="btn btn-primary">ارسال</button>
                        </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <script>
                      document.addEventListener("DOMContentLoaded", function (event) {
                          CKEDITOR.replace('ckeditor{{ $item->id }}', {
                              // Load the Farsi interface.
                              language: 'fa'
                          });
                      });
                  </script>
@endforeach
