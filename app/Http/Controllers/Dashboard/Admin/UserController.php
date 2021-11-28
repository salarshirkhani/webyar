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
use App\Models\Absence;
use App\Models\EmployeeProject;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;
use Hekmatinasser\Verta\Verta;
use Carbon\Carbon;

class UserController extends Controller
{
    public function GetUsers()
    {
        $users=User::withTrashed()->where('type','employee')->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.users.employee', ['users' => $users]);
    }

    public function GetProfile($id) {
        $post = User::find($id);
        $task=Task::where('employee_id',$id)->orderBy('created_at', 'desc')->get();
        $employee=EmployeeProject::where('employee_id',$id)->orderBy('created_at', 'desc')->get();
        $phase=Phase::whereHas('for', function($q) {
            $q->whereHas('employees', function($q) {
                $q->where('users.id', Auth::id());
            });
        })->get();
        $users = EmployeeProject::where('employee_id', Auth::id())->get();
        return view('dashboard.admin.users.profile', ['id' => $id,'post' => $post,'phase' => $phase,'users' => $users,'employee' => $employee,'task' => $task]);
    }

    public function DeletePost($id)
    {
        $post = User::withTrashed()->find($id);
        if (!$post->trashed()) {
            $post->delete();
        }
        else {
            $post->forceDelete();
        }

        return redirect()->route('dashboard.admin.users.employee', ['id' => $id])->with('info', 'کاربر پاک شد');
    }

    public function GetEditPost($id)
    {
        $post = User::find($id);
        return view('dashboard.admin.users.edit', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost($id,Request $request)
    {
        $post = User::find($request->input('id'));
        if (!is_null($post)) {
            $post->first_name = $request->input('first_name');
            $post->last_name = $request->input('last_name');
            $post->mobile = $request->input('mobile');
            $post->situation = $request->input('situation');
            $post->email = $request->input('email');
            $post->birthdate = $request->input('birthdate');
            if (!empty($password = $request->input('password')))
                $post->password = \Hash::make($password);
            $post->save();
        }
        return redirect()->route('dashboard.admin.users.employee',$post->id)->with('info', 'کاربر ویرایش شد');
    }

    public function restore($id) {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->back()->with('info', 'کاربر بازگردانی شد!');
    }

}
