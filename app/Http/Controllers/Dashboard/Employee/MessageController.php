<?php

namespace App\Http\Controllers\Dashboard\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\Phase;
use App\Models\message;
use App\Models\EmployeeProject;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth; 
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;
use Hekmatinasser\Verta\Verta;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function GetMessage()
    {
        $message=message::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('dashboard.employee.message.manage', ['message' => $message]);
    }

    public function ShowMessage($id){
        $message = message::where('user_id', Auth::user()->id)->where('id', $id)->FIRST();
        $post=message::find($id);
        if (!is_null($post)) {
            $post->status = 'seen';
            $post->save();
        }
        return view('dashboard.employee.message.show', ['message' => $message]);  
    }

}