<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\InvoiceCreateRequest;
use App\Http\Requests\Dashboard\Admin\InvoiceUpdateRequest;
use App\Models\Invoice;
use App\Http\Requests;
use App\Models\Project;
use App\Models\User;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.invoice.index', ['invoices' => Invoice::all()]);
    }

    public function create()
    {
        $customers = User::where('type', 'customer')->get();
        $projects = Project::all();
        return view('dashboard.admin.invoice.create', compact('customers', 'projects'));
    }

    public function store(InvoiceCreateRequest $request)
    {
        $data = $request->validated();
        $data['status'] = Invoice::STATE_UNPAID;
        $post = new Invoice();
        $post->fill($data);
        $post->save();
        return redirect()->route('dashboard.admin.invoice.index')->with('info', ' فاکتور جدید ذخیره شد و نام آن' .' ' . $request->input('title'));
    }

    public function destroy(Invoice $invoice){

        $invoice->delete();
        return redirect()->route('dashboard.admin.invoice.index')->with('info', 'فاکتور پاک شد!');
    }

    public function edit(Invoice $invoice)
    {
        $customers = User::where('type', 'customer')->get();
        $projects = Project::all();
        return view('dashboard.admin.invoice.edit', compact('invoice', 'customers', 'projects'));
    }

    public function update(InvoiceUpdateRequest $request, Invoice $invoice)
    {
        $invoice->update($request->validated());
        $invoice->save();
        return redirect()->route('dashboard.admin.invoice.index')->with('info', 'فاکتور ویرایش شد!');
    }

}
