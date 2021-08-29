<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\SalaryCreateRequest;
use App\Http\Requests\Dashboard\Admin\SalaryUpdateRequest;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\User;
use App\Models\Project;
use App\Models\Phase;
use App\Models\Task;
use App\Models\EmployeeProject;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class SalaryController extends Controller
{
    public function GetIndex()
    {
        return view('dashboard.admin.salary.index', ['salaries' => Salary::all()]);
    }

    public function GetCreatePost()
    {
        return view('dashboard.admin.salary.create');
    }

    public function CreatePost(SalaryCreateRequest $request)
    {
        $post = new Salary($request->validated());
        $post->save();
        return redirect()->route('dashboard.admin.salary.index')->with('info', ' دستمزد جدید ذخیره شد و نام آن' .' ' . $request->input('title'));
    }

    public function DeletePost(Salary $salary){

        $salary->delete();
        return redirect()->route('dashboard.admin.salary.index')->with('info', 'دستمزد پاک شد!');
    }

    public function GetEditPost(Salary $salary)
    {
        return view('dashboard.admin.salary.edit', ['salary' => $salary]);
    }

    public function UpdatePost(SalaryUpdateRequest $request, Salary $salary)
    {
        $salary->update($request->validated());
        $salary->save();
        return redirect()->route('dashboard.admin.salary.index')->with('info', 'دستمزد ویرایش شد!');
    }

}
