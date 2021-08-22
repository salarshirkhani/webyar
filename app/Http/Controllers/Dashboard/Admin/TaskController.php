<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
use Hekmatinasser\Verta\Verta;

class TaskController extends Controller
{
    public function GetCreatePost($id)
    {
        return view('dashboard.admin.task.create', ['id' => $id]);
    }

    public function CreatePost($id,Request $request)
    {
        $post = new Task([
            'title' => $request->input('title'),
            'employee_id' => $request->input('employee_id'),
            'project_id' => $id,
            'description' => $request->input('description'),
            'phase_id' => $request->input('phase_id'),
            'start_date' => Carbon::fromJalali($request->input('start_date')),
            'finish_date' => Carbon::fromJalali($request->input('finish_date')),
            'status' => $request->input('status'),
        ]);
        $post->save();
        return redirect()->route('dashboard.admin.task.manage', ['id' => $id])->with('info', 'تسک جدید اضافه شد ' );
    }
    public function GetManagePost($id,Request $request)
    {
        $task=Task::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        $project=Project::find($id);
        $phase= Phase::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        $posts = EmployeeProject::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.task.manage', ['posts' => $posts,'id' => $id,'phase' => $phase,'project' => $project,'task' => $task]);
    }

    public function DeletePost($id,$project_id){
        $post = Task::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.task.manage', ['id' => $project_id])->with('info', 'تسک پاک شد');
    }

    public function GetEditPost($id)
    {
        $post = Task::find($id);
        $project=Project::find($id);
        $phase= Phase::where('project_id',$post->project_id)->orderBy('created_at', 'desc')->get();
        $posts = EmployeeProject::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.task.updatetask', ['posts' => $posts,'id' => $id,'phase' => $phase,'project' => $project,'post' => $post]);
    }

    public function UpdatePost($id,Request $request)
    {
        $post = Task::find($request->input('id'));
        if (!is_null($post)) {
            $post->title = $request->input('title');
            $post->project_id = $request->input('project_id');
            $post->employee_id = $request->input('employee_id');
            $post->phase_id = $request->input('phase_id');
            $post->description = $request->input('description');
            $post->start_date = Carbon::fromJalali($request->input('start_date'));
            $post->finish_date = Carbon::fromJalali($request->input('finish_date'));
            $post->status = $request->input('status');
            $post->save();
        }
        return redirect()->route('dashboard.admin.task.manage',$post->project_id)->with('info', 'تسک ویرایش شد');
    }

}
