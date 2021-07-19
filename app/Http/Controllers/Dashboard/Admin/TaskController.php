<?php

namespace App\Http\Controllers\Dashboard\Admin;

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
            'phase_id' => $request->input('phase_id'),
            'start_date' => $request->input('start_date'),
            'finish_date' => $request->input('finish_date'),
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
        return view('dashboard.admin.task.updatetask', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost($id,Request $request)
    {
        $post = Task::find($request->input('id'));
        if (!is_null($post)) {
            $post->title = $request->input('title');
            $post->project_id = $request->input('project_id');
            $post->employee_id = $request->input('employee_id');
            $post->phase_id = $request->input('phase_id');
            $post->start_date = $request->input('start_date');
            $post->finish_date = $request->input('finish_date');
            $post->status = $request->input('status');
            $post->save();
        }
        return redirect()->route('dashboard.admin.task.manage',$post->project_id)->with('info', 'تسک ویرایش شد');
    }

}