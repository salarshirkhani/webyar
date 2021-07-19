<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\User;
use App\Models\Project;
use App\Models\Phase;
use App\Models\EmployeeProject;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.admin.employee.create');
    }

    public function CreatePost(Request $request)
    {
        $post = new EmployeeProject([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_date' => $request->input('start_date'),
            'finish_date' => $request->input('finish_date'),
        ]);
        $post->save();
        return redirect()->route('dashboard.admin.employee.manage')->with('info', '  پروژه جدید ذخیره شد و نام آن' .' ' . $request->input('title'));
    }
    public function GetManagePost(Request $request)
    {
        $posts = EmployeeProject::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.employee.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = EmployeeProject::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.employee.manage')->with('info', 'پروژه پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = EmployeeProject::find($id);
        return view('dashboard.admin.employee.updatepost', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost(Request $request)
    {
        $post = EmployeeProject::find($request->input('id'));
        if (!is_null($post)) {
            $post->title = $request->input('title');
            $post->description = $request->input('description');
            $post->start_date = $request->input('start_date');
            $post->finish_date = $request->input('finish_date');
            $post->save();
        }
        return redirect()->route('dashboard.admin.employee.manage',$post->id)->with('info', 'پروژه ویرایش شد');
    }

}