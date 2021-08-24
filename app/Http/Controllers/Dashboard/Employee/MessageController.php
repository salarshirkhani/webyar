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

    public function GetAnswerMessage(Request $request, message $message)
    {
        return view('dashboard.employee.message.answer', ['message' => $message]);
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
        return redirect()->route('dashboard.employee.message.manage')->with('info', '  پیام جدید ارسال شد و نام آن' .' ' . $request->input('title'));
    }

}
