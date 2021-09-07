<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\TaskCreateRequest;
use App\Http\Requests\Dashboard\Admin\TaskUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Task;
use App\Models\Project;
use App\Models\Phase;
use App\Models\EmployeeProject;

class TaskController extends Controller
{
    public function GetCreatePost($id)
    {
        return view('dashboard.admin.task.create', ['id' => $id]);
    }

    public function CreatePost($id,TaskCreateRequest $request)
    {
        $data = array_merge($request->validated(), [
            'project_id' => $id,
        ]);

        $post = new Task($data);
        $post->save();
        return redirect()->route('dashboard.admin.task.manage', ['id' => $id])->with('info', 'مسئولیت جدید اضافه شد ' );
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
        return redirect()->route('dashboard.admin.task.manage', ['id' => $project_id])->with('info', 'مسئولیت پاک شد');
    }

    public function GetEditPost($id)
    {
        $post = Task::find($id);
        $project=Project::find($id);
        $phase= Phase::where('project_id',$post->project_id)->orderBy('created_at', 'desc')->get();
        $posts = EmployeeProject::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.task.updatetask', ['posts' => $posts,'id' => $id,'phase' => $phase,'project' => $project,'post' => $post]);
    }

    public function UpdatePost($id,TaskUpdateRequest $request)
    {
        $post = Task::find($request->input('id'));
        if (!is_null($post)) {
            $post->fill($request->validated());
            $post->save();
        }
        return redirect()->route('dashboard.admin.task.manage',$post->project_id)->with('info', 'مسئولیت ویرایش شد');
    }

}
