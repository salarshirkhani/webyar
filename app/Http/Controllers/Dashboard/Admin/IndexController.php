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

class IndexController extends Controller
{
    public function get() {
        $posts = Project::orderBy('created_at', 'desc')->get();
        $users=User::where('type','employee')->orderBy('created_at', 'desc')->get();
        $from_date_finishing = now();
        $to_date_finishing = now()->addDays(3);
        $finishing_projects = Project
            ::where('finish_date', '>=', $from_date_finishing)
            ->where('finish_date', '<=', $to_date_finishing)
            ->get();
        $finishing_phases = Phase
            ::where('finish_date', '>=', $from_date_finishing)
            ->where('finish_date', '<=', $to_date_finishing)
            ->get();
        $overdue_projects = Project
            ::where('finish_date', '<=', now())
            ->where('status', '!=', 'done')
            ->get();

        return view('dashboard.admin.index', [
            'posts' => $posts,
            'users' => $users,
            'finishing_projects' => $finishing_projects,
            'finishing_phases' => $finishing_phases,
            'overdue_projects' => $overdue_projects,
        ]);
    }
}
