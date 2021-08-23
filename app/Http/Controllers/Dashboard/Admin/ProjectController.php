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
use App\Models\Task;
use App\Models\EmployeeProject;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.admin.project.create');
    }

    public function GetProject($id)
    {
        $post = Project::find($id);
        $phase= Phase::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        $users = EmployeeProject::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        $tasks= Task::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.project.index', ['post' => $post, 'id' => $id ,'phase' => $phase,'users' => $users , 'tasks' =>$tasks ]);
    }

    public function CreatePost(Request $request)
    {
        $post = new Project([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date' => Carbon::fromJalali($request->input('start_date')),
            'finish_date' => Carbon::fromJalali($request->input('finish_date')),
        ]);
        $post->save();
        return redirect()->route('dashboard.admin.project.manage')->with('info', '  پروژه جدید ذخیره شد و نام آن' .' ' . $request->input('title'));
    }
    public function GetManagePost(Request $request)
    {
        $posts = Project::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.project.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $phase= Phase::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        foreach($phase as $phases){
            $phases->delete();
        }

        $users = EmployeeProject::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        foreach($users as $userss){
        $userss->delete();
        }

        $task= Task::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        foreach($task as $tasks){
        $tasks->delete();
        }

        $post = Project::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.project.manage')->with('info', 'پروژه پاک شد');
    }

    public function GetEditPost($id)
    {
        $post = Project::find($id);
        return view('dashboard.admin.project.updatepost', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost(Request $request)
    {
        $post = Project::find($request->input('id'));
        if (!is_null($post)) {
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->start_date = Carbon::fromJalali($request->input('start_date'));
            $post->finish_date = Carbon::fromJalali($request->input('finish_date'));
            $post->save();
        }
        return redirect()->route('dashboard.admin.project.manage',$post->id)->with('info', 'پروژه ویرایش شد');
    }

}
