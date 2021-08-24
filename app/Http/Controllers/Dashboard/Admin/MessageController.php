<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
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
        $message=message::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.message.manage', ['message' => $message]);
    }

    public function GetCreatePost(Request $request)
    {
        $user_id=$request->input('user_id');
        $users = User::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.message.create', ['users' => $users,'user_id' => $user_id]);
    }

    public function CreatePost(Request $request)
    {
        $post = new message([
            'sender_id' => Auth::user()->id,
            'user_id' => $request->input('user_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        //--------------
        if($request->input('file')!=NULL){
        $uploadedFile = $request->file('file');
        $filename = $uploadedFile->getClientOriginalName();
        Storage::disk('public')->putFileAs('/files/'.$filename, $uploadedFile, $filename);
        $post->file = $filename;
        }
        $post->save();
        return redirect()->route('dashboard.admin.message.manage')->with('info', '  پیام جدید ارسال شد و نام آن' .' ' . $request->input('title'));
    }


    public function GetAnswerMessage(Request $request, message $message)
    {
        return view('dashboard.admin.message.answer', ['message' => $message]);
    }

    public function AnswerMessage(Request $request, message $message)
    {
        if ($message->answer_id != null)
            return;

        $post = new message([
            'sender_id' => Auth::user()->id,
            'user_id' => $message->sender_id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        //--------------
        if($request->input('file')!=NULL){
            $uploadedFile = $request->file('file');
            $filename = $uploadedFile->getClientOriginalName();
            Storage::disk('public')->putFileAs('/files/'.$filename, $uploadedFile, $filename);
            $post->file = $filename;
        }
        $post->save();
        $message->answer()->associate($post);
        $message->save();
        return redirect()->route('dashboard.admin.message.manage')->with('info', '  پیام جدید ارسال شد و نام آن' .' ' . $request->input('title'));
    }

    public function DeletePost($id){
        $post = message::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.message.manage')->with('info', 'پیام پاک شد');
    }

    public function ShowMessage($id){
        $message = message::find($id);
        return view('dashboard.admin.message.show', ['message' => $message]);
    }

    public function GetEditPost($id)
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $post = message::find($id);
        return view('dashboard.admin.message.update', ['post' => $post, 'id' => $id , 'users' => $users]);
    }

    public function UpdatePost($id,Request $request)
    {
        $post = message::find($request->input('id'));
        if (!is_null($post)) {
            $post->user_id = $request->input('user_id');
            $post->title = $request->input('title');
            $post->content= $request->input('content');
            //--------------
            if($request->input('file')!=NULL){
            $uploadedFile = $request->file('file');
            $filename = $uploadedFile->getClientOriginalName();
            Storage::disk('public')->putFileAs('/files/'.$filename, $uploadedFile, $filename);
            $post->file = $filename;
            }
            $post->save();
        }
        return redirect()->route('dashboard.admin.message.manage')->with('info', 'پیام ویرایش شد');
    }

}
