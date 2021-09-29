<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\ProductCreateRequest;
use App\Http\Requests\Dashboard\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.product.index', [
            'products' => Product::orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.admin.product.create', [
            'categories' => Category::hierarchy(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('picture'))
            $data['picture'] = $request->file('picture')->store('products', 'public');
        Product::create($data);
        return redirect()->route('dashboard.admin.product.index')->with('info', 'محصول ساخته شد!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('dashboard.admin.product.edit', [
            'product' => $product,
            'categories' => Category::hierarchy(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {

        $data = $request->validated();
        if ($request->hasFile('picture'))
            $data['picture'] = $request->file('picture')->store('products', 'public');
        else
            unset($data['picture']);

        $product->update($data);
        return redirect()->route('dashboard.admin.product.index')->with('info', 'محصول ویرایش شد!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('info', 'محصول پاک شد!');
    }
}
