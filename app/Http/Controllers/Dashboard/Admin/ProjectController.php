<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function GetCreatePost()
    {
        return view('dashboard.admin.project.create');
    }

    public function CreatePost(Request $request)
    {
        $post = new Project([
            'title' => $request->input('title'),
            'start_date' => $request->input('start_date'),
            'finish_date' => $request->input('finish_date'),
        ]);
        $post->save();
        return redirect()->route('dashboard.admin.project.create')->with('info', '  پروژه جدید ذخیره شد و نام آن' . $request->input('title'));
    }
    public function GetManagePost(Request $request)
    {
        $posts = Project::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.project.manage', ['posts' => $posts]);
    }

    public function DeletePost($id){
        $post = Project::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.project.manage')->with('info', 'پست پاک شد');
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
            $post->explain = $request->input('explain');
            $post->writer = $request->input('writer');
            $post->content = $request->input('content');
            $post->save();
        }
        return redirect()->route('dashboard.admin.project.updatepost',$post->id)->with('info', 'پست ویرایش شد');
    }

}