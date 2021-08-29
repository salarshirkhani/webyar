<?php

namespace App\Http\Controllers\Dashboard\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Employee\TaskCreateRequest;
use App\Http\Requests\Dashboard\Employee\TaskStatusUpdateRequest;
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

class DailyController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.admin.daily.create');
    }

    public function CreatePost(TaskCreateRequest $request)
    {
        $data = $request->validated();
        $data['employee_id'] = Auth::user()->id;
        $post = new Task($data);
        $post->save();
        return redirect()->route('dashboard.admin.daily.manage')->with('info', 'مسئولیت جدید اضافه شد ' );
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
        $task=Task::where('status','notwork')->where('employee_id',Auth::user()->id)->orderBy('finish_date', 'ASC')->get();
        return view('dashboard.admin.daily.manage', [
        'task' => $task,
        'absence' => $absence,
        'diff' => $diff,
        'message' => $message
        ]);
    }

    public function GetTask($id,Request $request)
    {
        $task=Task::find($id);
        return view('dashboard.admin.daily.show', ['task' => $task]);
    }

    public function UpdatePost($id, TaskStatusUpdateRequest $request)
    {
        $task=Task::where('employee_id',Auth::user()->id)->orderBy('finish_date', 'ASC')->get();
        $post = Task::find($request->input('id'));
        if (!is_null($post)) {
            $post->update($request->validated());
        }
        return redirect()->route('dashboard.admin.daily.manage')->with('info', 'مسئولیت انجام شد');
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
        return redirect()->route('dashboard.admin.daily.manage')->with('info', 'حضوری شما زده شد ' );
    }
    public function AbsenceEnd($id,Request $request)
    {
        $post = Absence::find($id);
        if (!is_null($post)) {
            $post->exit = Carbon::now()->isoFormat('HH:mm:ss');
            $post->hours = strtotime(Carbon::now()->isoFormat('HH:mm:ss')) - strtotime($post->enter);
            $post->save();
        }
        return redirect()->route('dashboard.admin.daily.manage')->with('info', 'ساعت خروج شما ثبت شد ' );
    }

}
