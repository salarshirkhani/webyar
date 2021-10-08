<?php

namespace App\Http\Controllers\Dashboard\Employee;


use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Employee\TaskCreateRequest;
use App\Http\Requests\Dashboard\Employee\TaskStatusUpdateRequest;
use App\Http\Requests\Dashboard\Employee\TaskUpdateRequest;
use App\Models\Score;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Phase;
use App\Models\Absence;
use App\Models\message;
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

    public function CreatePost(TaskCreateRequest $request)
    {
        $data = $request->validated();
        $data['employee_id'] = Auth::user()->id;
        $post = new Task($data);
        $post->save();
        return redirect()->route('dashboard.employee.task.manage')->with('info', 'مسئولیت جدید اضافه شد ' );
    }
    public function GetManagePost(Request $request)
    {
        $message=message::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $absence=Absence::orderBy('created_at', 'desc')
        ->where('employee_id',Auth::user()->id)
        ->where('date',Carbon::now()->format('Y-m-d'))->FIRST();
        $diff=NULL;
        if($absence != NULL){
        if($absence->exit != NULL){
            $diff = strtotime($absence->exit) - strtotime($absence->enter);
            if($diff < 60){
                $diff= $diff.' ثانیه ';
            }
            elseif($diff < 3600){
                $diff=  round($diff / 60,0,1).' دقیقه ';
            }
            elseif($diff >= 3660 && $diff < 86400){
                $diff=  round($diff / 3600,0,1).' ساعت ';
            }
            elseif($diff > 86400){
                $diff=  round($diff / 86400,0,1).' روز ';
            }
        }
        }
        $task=Task::managePage()->where('employee_id',Auth::user()->id)->orderBy('finish_date', 'ASC')->get();
        return view('dashboard.employee.task.manage', [
        'task' => $task,
        'absence' => $absence,
        'diff' => $diff,
        'message' => $message
        ]);
    }

    public function GetTask($id,Request $request)
    {
        $task=Task::find($id);
        return view('dashboard.employee.task.show', ['task' => $task]);
    }

    public function UpdatePost($id, TaskStatusUpdateRequest $request)
    {
        $post = Task::find($request->input('id'));
        if (!is_null($post)) {
            $old_status = $post->status;
            $post->update($request->validated());
            if ($post->status == 'done' && $old_status != $post->status)
                $post->applyEmployeeScore(Auth::user());
        }
        return redirect()->route('dashboard.employee.task.manage')->with('info', 'مسئولیت انجام شد');
    }


    public function EditPost($id, TaskUpdateRequest $request)
    {
        $data = $request->validated();
        $data['employee_id'] = Auth::user()->id;
        $post = Task::find($id);
        if (!is_null($post)) {
            $old_status = $post->status;
            $post->update($data);
            if ($post->status == 'done' && $old_status != $post->status)
                $post->applyEmployeeScore(Auth::user());
        }
        return redirect()->route('dashboard.employee.task.manage')->with('info', 'مسئولیت ویرایش شد');
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
            $post->hours = strtotime(Carbon::now()->isoFormat('HH:mm:ss')) - strtotime($post->enter);
            $post->save();
        }
        return redirect()->route('dashboard.employee.task.manage')->with('info', 'ساعت خروج شما ثبت شد ' );
    }

}
