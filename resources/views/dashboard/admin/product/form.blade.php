<x-text-group required name="name" label="عنوان" :model="$model ?? null"/>
<x-text-group required name="short_description" label="توضیحات کوتاه" :model="$model ?? null"/>
<x-textarea-group required name="description" label="توضیحات کامل" :model="$model ?? null"/>
<x-text-group type="number" required name="price" label="قیمت" :model="$model ?? null"/>
<x-select-group name="category_id" label="دسته‌بندی" required :model="$model ?? null">
    @foreach($categories as $category)
        <x-select-item :value="$category->id">
            @if(!empty($category->parent_id))@for($i = 2; $i <= $category->level; $i ++)&nbsp;&nbsp;&nbsp;@endfor&#x2500;&#x251c; @endif{{ $category->name }}
        </x-select-item>
    @endforeach
</x-select-group>
<x-file-group name="picture" label="تصویر محصول" />
