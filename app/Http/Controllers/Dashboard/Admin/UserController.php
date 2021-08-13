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
use Hekmatinasser\Verta\Verta;
use Carbon\Carbon;

class UserController extends Controller
{
    public function GetUsers()
    {
        $users=User::where('type','employee')->orderBy('created_at', 'desc')->get();
        $employee=EmployeeProject::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.users.employee', ['users' => $users,'employee' => $employee]);
    }

    public function GetProfile($id) {
        $post = User::find($id);
        $task=Task::where('employee_id',$id)->orderBy('created_at', 'desc')->get();
        $employee=EmployeeProject::where('employee_id',$id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.users.profile', ['id' => $id,'post' => $post,'employee' => $employee,'task' => $task]);
    }

}