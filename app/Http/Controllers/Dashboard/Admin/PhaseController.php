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

class PhaseController extends Controller
{
    public function CreatePost($id,Request $request)
    {
        $project = Project::findOrFail($id);
        $post = new Phase([
            'title' => $request->input('title'),
            'project_id' => $id,
            'start_date' => Carbon::fromJalali($request->input('start_date')),
            'finish_date' => Carbon::fromJalali($request->input('finish_date')),
        ]);
        if ($post->finish_date->lt($post->start_date))
            return redirect()->back()->withErrors(['finish_date' => 'تاریخ پایان نباید از تاریخ شروع کوچک‌تر باشد.']);
        if ($post->start_date->lt($project->start_date))
            return redirect()->back()->withErrors(['start_date' => 'تاریخ آغاز این فاز نباید از تاریخ آغاز پروژه زود‌تر باشد.']);
        if ($post->finish_date->gt($project->finish_date))
            return redirect()->back()->withErrors(['finish_date' => 'تاریخ پایان این فاز نباید از تاریخ پایان پروژه دیرتر باشد.']);
        $post->save();
        return redirect()->back()->with('info', '  فاز جدید ذخیره شد و نام آن' .' ' . $request->input('title'));
    }
    public function DeletePost($id,$project_id){
        $post = Phase::find($id);
        $post->delete();
        return redirect()->back()->with('info', 'فاز پاک شد');
    }

    public function UpdatePost($id,Request $request)
    {
        $project = Project::findOrFail($request->input('project_id'));
        $post = Phase::find($request->input('id'));
        if (!is_null($post)) {
            $post->title = $request->input('title');
            $post->project_id = $request->input('project_id');
            $post->start_date = Carbon::fromJalali($request->input('start_date'));
            $post->finish_date = Carbon::fromJalali($request->input('finish_date'));
            if ($post->finish_date->lt($post->start_date))
                return redirect()->back()->withErrors(['finish_date' => 'تاریخ پایان نباید از تاریخ شروع کوچک‌تر باشد.']);
            if ($post->start_date->lt($project->start_date))
                return redirect()->back()->withErrors(['start_date' => 'تاریخ آغاز این فاز نباید از تاریخ آغاز پروژه زود‌تر باشد.']);
            if ($post->finish_date->gt($project->finish_date))
                return redirect()->back()->withErrors(['finish_date' => 'تاریخ پایان این فاز نباید از تاریخ پایان پروژه دیرتر باشد.']);
            $post->save();
        }
        return redirect()->back()->with('info', 'فاز ویرایش شد');
    }

       //TASK CONTROLLER

       public function GetManageTask($id)
       {
        $task=Task::where('phase_id',$id)->orderBy('created_at', 'desc')->get();
        $phase = Phase::find($id);
        $posts = EmployeeProject::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.phase.tasks', ['posts' => $posts,'id' => $id,'task' => $task,'phase' => $phase]);
       }

}
