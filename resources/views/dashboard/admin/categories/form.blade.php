<x-text-group name="name" label="نام" :model="$model ?? null" />
<x-text-group name="description" label="توضیح کوتاه" :model="$model ?? null" />
<x-text-group name="slug" label="نام کوتاه انگلیسی (تنها a تا z و عدد و - مورد قبول)" :model="$model ?? null" />
<x-select-group name="parent_id" label="دسته‌بندی مادر" :model="$model ?? null">
    <x-select-item value="">بدون مادر</x-select-item>
    @foreach($categories->reject(function($value, $key) { return !empty($model) ? $value->is($model) : false; }) as $category)
        <x-select-item :value="$category->id">@if(!empty($category->parent_id))@for($i = 2; $i <= $category->level; $i ++)&nbsp;&nbsp;&nbsp;@endfor&#x2500;&#x251c; @endif{{ $category->name }}</x-select-item>
    @endforeach
</x-select-group>