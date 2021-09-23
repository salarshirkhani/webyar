<x-text-group required name="title" label="عنوان" :model="$model ?? null" />
<x-textarea-group required name="description" label="توضیحات" :model="$model ?? null"></x-textarea-group>
<x-text-group type="number" required name="amount" label="مبلغ" :model="$model ?? null" />
<x-select-group name="user_id" label="مشتری پرداخت‌کننده" :model="$model ?? null">
    <x-select-item value=""></x-select-item>
    @foreach($customers as $item)
        <x-select-item :value="$item->id">{{ $item->first_name }} {{ $item->last_name }}</x-select-item>
    @endforeach
</x-select-group>
<x-select-group name="project_id" label="پروژه مرتبط" :model="$model ?? null">
    <x-select-item value=""></x-select-item>
    @foreach($projects as $item)
        <x-select-item :value="$item->id">{{ $item->title }}</x-select-item>
    @endforeach
</x-select-group>
