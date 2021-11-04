<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\User;
use App\Models\Project;
use App\Models\Phase;
use App\Models\EmployeeProject;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function CreatePost($id,Request $request)
    {
        if (EmployeeProject::where('employee_id', $request->input('employee_id'))->where('project_id', $id)->exists())
            return redirect()->back()->with('error', 'این کاربر قبلا به پروژه اضافه شده‌است!' );

        $post = new EmployeeProject([
            'cost' => $request->input('cost'),
            'employee_id' => $request->input('employee_id'),
            'project_id' => $id,
            'start_date' => Carbon::fromJalali($request->input('start_date')),
            'finish_date' => Carbon::fromJalali($request->input('finish_date')),
        ]);
        if ($post->finish_date->lt($post->start_date))
            return redirect()->back()->withErrors(['finish_date' => 'تاریخ پایان نباید از تاریخ شروع کوچک‌تر باشد.']);
        $post->save();
        return redirect()->back()->with('info', 'کاربر جدید اضافه شد ' )->with('show-create-employee', '');
    }

    public function DeletePost($id,$project_id){
        $post = EmployeeProject::find($id);
        $post->delete();
        return redirect()->back()->with('info', 'کاربر از پروژه پاک شد');
    }

    public function UpdatePost($id,Request $request)
    {
        $post = EmployeeProject::find($request->input('id'));
        if (!is_null($post)) {
            $post->cost = $request->input('cost');
            $post->project_id = $request->input('project_id');
            $post->employee_id = $request->input('employee_id');
            $post->start_date = Carbon::fromJalali($request->input('start_date'));
            $post->finish_date = Carbon::fromJalali($request->input('finish_date'));
            $post->salary_id = $request->input('salary_id');
            if ($post->finish_date->lt($post->start_date))
                return redirect()->back()->withErrors(['finish_date' => 'تاریخ پایان نباید از تاریخ شروع کوچک‌تر باشد.']);
            $post->save();
        }
        return redirect()->back()->with('info', 'کاربر پروژه ویرایش شد');
    }

}
