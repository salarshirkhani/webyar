<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\User;
use App\Models\Project;
use App\Models\Phase;
use Illuminate\Auth\Access\Gate; 
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;

class PhaseController extends Controller
{
    public function GetCreatePost($id)
    {
        return view('dashboard.admin.phase.create', ['id' => $id]);
    }

    public function CreatePost($id,Request $request)
    {
        $post = new Phase([
            'title' => $request->input('title'),
            'project_id' => $id,
            'start_date' => $request->input('start_date'),
            'finish_date' => $request->input('finish_date'),
        ]);
        $post->save();
        return redirect()->route('dashboard.admin.phase.manage', ['id' => $id])->with('info', '  فاز جدید ذخیره شد و نام آن' .' ' . $request->input('title'));
    }
    public function GetManagePost($id,Request $request)
    {
        $posts = Phase::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.phase.manage', ['posts' => $posts,'id' => $id]);
    }

    public function DeletePost($id){
        $post = Phase::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.phase.manage', ['id' => $id])->with('info', 'فاز پاک شد');
    }

    public function GetEditPost($id)
    { 
        $post = Phase::find($id);
        return view('dashboard.admin.phase.updatepost', ['post' => $post, 'id' => $id]);
    }

    public function UpdatePost($id,Request $request)
    {
        $post = Phase::find($request->input('id'));
        if (!is_null($post)) {
            $post->title = $request->input('title');
            $post->project_id = $request->input('project_id');
            $post->start_date = $request->input('start_date');
            $post->finish_date = $request->input('finish_date');
            $post->save();
        }
        return redirect()->route('dashboard.admin.phase.updatepost',$post->id)->with('info', 'فاز ویرایش شد');
    }

}