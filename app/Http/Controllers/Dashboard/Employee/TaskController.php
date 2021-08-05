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
use App\Models\Absence;
use App\Models\EmployeeProject;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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
        $absence=Absence::orderBy('created_at', 'desc')->where('employee_id',Auth::user()->id)->where('date',Carbon::now()->format('Y-m-d'))->FIRST();
        $task=Task::where('status','notwork')->where('employee_id',Auth::user()->id)->orderBy('finish_date', 'ASC')->get();
        return view('dashboard.employee.task.manage', ['task' => $task,'absence' => $absence]);
    }

    public function GetTask($id,Request $request)
    {
        $task=Task::find($id);
        return view('dashboard.employee.task.show', ['task' => $task]);
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


    //ABSENCCE CONTROLLER
    public function Absence(Request $request)
    {
        $post = new Absence([
            'employee_id' => Auth::user()->id,
            'date' => Carbon::now(),
            'enter'=>Carbon::now()->isoFormat('HH:mm:ss')
        ]);
        $post->save();
        return redirect()->route('dashboard.employee.task.manage')->with('info', 'حضوری شما زده شد ' );
    }
    public function AbsenceEnd($id,Request $request)
    {
        $post = Absence::find($id);
        if (!is_null($post)) {
            $post->exit = Carbon::now()->isoFormat('HH:mm:ss');
            $post->save();
        }
        return redirect()->route('dashboard.employee.task.manage')->with('info', 'ساعت خروج شما ثبت شد ' );
    }

}