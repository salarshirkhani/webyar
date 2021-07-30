<?php

namespace App\Http\Controllers\Dashboard\Employee;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Phase;
use App\Models\EmployeeProject;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;


class TaskController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.employee.task.create');
    }

    public function CreatePost(Request $request)
    {
        $post = new Task([
            'title' => $request->input('title'),
            'employee_id' => Auth::user()->id,
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'finish_date' => $request->input('finish_date'),
            'status' => $request->input('status'),
        ]);
        $post->save();
        return redirect()->route('dashboard.employee.task.manage')->with('info', 'تسک جدید اضافه شد ' );
    }
    public function GetManagePost(Request $request)
    {
        $task=Task::where('status','notwork')->where('employee_id',Auth::user()->id)->orderBy('finish_date', 'ASC')->get();
        return view('dashboard.employee.task.manage', ['task' => $task]);
    }

    public function UpdatePost($id,Request $request)
    {
        $task=Task::where('employee_id',Auth::user()->id)->orderBy('finish_date', 'ASC')->get();
        $post = Task::find($request->input('id'));
        if (!is_null($post)) {
            $post->status = $request->input('status');
            $post->save();
        }
        return redirect()->route('dashboard.employee.task.manage')->with('info', 'تسک انجام شد');
    }
}