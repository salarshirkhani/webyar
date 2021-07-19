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

class EmployeeController extends Controller
{
    public function GetCreatePost($id)
    {
        return view('dashboard.admin.employee.create', ['id' => $id]);
    }

    public function CreatePost($id,Request $request)
    {
        $post = new EmployeeProject([
            'cost' => $request->input('cost'),
            'employee_id' => $request->input('employee_id'),
            'project_id' => $id,
            'start_date' => $request->input('start_date'),
            'finish_date' => $request->input('finish_date'),
        ]);
        $post->save();
        return redirect()->route('dashboard.admin.employee.manage', ['id' => $id])->with('info', 'کاربر جدید اضافه شد ' );
    }
    public function GetManagePost($id,Request $request)
    {
        $project=Project::find($id);
        $posts = EmployeeProject::where('project_id',$id)->orderBy('created_at', 'desc')->get();
        $users = User::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.employee.manage', ['posts' => $posts,'id' => $id,'users' => $users,'project' => $project]);
    }

    public function DeletePost($id,$project_id){
        $post = EmployeeProject::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.employee.manage', ['id' => $project_id])->with('info', 'کاربر از پروژه پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = EmployeeProject::find($id);
        return view('dashboard.admin.employee.updateemployee', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost($id,Request $request)
    {
        $post = EmployeeProject::find($request->input('id'));
        if (!is_null($post)) {
            $post->cost = $request->input('cost');
            $post->project_id = $request->input('project_id');
            $post->employee_id = $request->input('employee_id');
            $post->start_date = $request->input('start_date');
            $post->finish_date = $request->input('finish_date');
            $post->save();
        }
        return redirect()->route('dashboard.admin.employee.manage',$post->project_id)->with('info', 'کاربر پروژه ویرایش شد');
    }

}