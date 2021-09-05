<?php

namespace App\Http\Controllers\Dashboard\Employee;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Phase;
use App\Models\EmployeeProject;
use App\Models\message;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function profile() {
        $message=message::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        $employee=EmployeeProject::where('employee_id',Auth::user()->id)->with('project')->orderBy('created_at', 'desc')->get();
        $task=Task::where('employee_id',Auth::user()->id)->orderBy('finish_date', 'ASC')->get();
        return view('dashboard.employee.index', ['employee' => $employee , 'task' => $task , 'message' => $message]);
    }
        public function get() {
        return redirect()->route('dashboard.employee.task.manage');
    }
}
