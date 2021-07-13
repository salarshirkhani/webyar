<div class="form-row">
    <x-text-group name="title" label="عنوان" :model="$model ?? null" width="col-md-8" />
    <x-text-group name="priority" label="اولویت" :model="$model ?? null" width="col-md-4" />
</div>
<x-text-group name="url" label="URL" :model="$model ?? null" />
<x-file-group name="image" label="تصویر" />
