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
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function profile() { 
        return view('dashboard.employee.index');
    }
        public function get() { 
        $task=Task::where('status','notwork')->where('employee_id',Auth::user()->id)->orderBy('finish_date', 'ASC')->get();
        return view('dashboard.employee.task.manage', ['task' => $task]);
    }
}
