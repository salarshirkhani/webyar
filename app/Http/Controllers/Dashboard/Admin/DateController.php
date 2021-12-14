<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Session\Store;
use App\Models\date;
use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Storage;
use Hekmatinasser\Verta\Verta;
use Carbon\Carbon;

class DateController extends Controller
{
    public function GetDate()
    {
        $date=date::orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.date.manage', ['posts' => $date]);
    }

    public function GetCreatePost(Request $request)
    {
        return view('dashboard.admin.date.create');
    }

    public function CreatePost(Request $request)
    {
        $post = new date([
            'date' => Carbon::fromJalali($request->input('date')),
        ]);
        $post->save();
        return redirect()->route('dashboard.admin.date.manage')->with('info', 'تاریخ جدید ایجاد شد ' );
    }

    public function DeletePost($id){
        $post = date::find($id);
        $post->delete();
        return redirect()->route('dashboard.admin.date.manage')->with('info', 'تاریخ پاک شد');
    }

    public function GetEditPost($id)
    {
        $users = User::orderBy('created_at', 'desc')->get();
        $post = message::find($id);
        return view('dashboard.admin.date.update', ['post' => $post, 'id' => $id , 'users' => $users]);
    }

}
