<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\CategoryStoreRequest;
use App\Http\Requests\Dashboard\Admin\CategoryUpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.categories.index', [
            'categories' => Category
                ::orderBy('created_at', 'desc')
                ->get()
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.categories.create', [
            'categories' => Category::whereNull('parent_id')->get(),
        ]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        if (!empty($data['parent_id']))
            $category->parent()->associate($data['parent_id']);
        $category->save();

        return redirect()
            ->route('dashboard.admin.category.index')
            ->with('success', __('دسته‌بندی موردنظر با موفقیت ساخته شد!'));
    }

    public function edit(Category $category)
    {
        return view('dashboard.admin.categories.edit', [
            'category' => $category,
            'categories' => Category::whereNull('parent_id')->get(),
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $data = $request->validated();
        $category->update($data);
        $category->parent()->associate($data['parent_id']);
        $category->save();

        return redirect()
            ->route('dashboard.admin.category.index')
            ->with('success', __('دسته‌بندی موردنظر با موفقیت ویرایش شد!'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()
            ->route('dashboard.admin.category.index')
            ->with('success', __('دسته‌بندی موردنظر با موفقیت حذف شد!'));
    }
}
