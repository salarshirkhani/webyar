<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function edit() {
        return view('dashboard.' . \Auth::user()->type . '.profile.edit');
    }

    public function update(ProfileUpdateRequest $request) {
        \Auth::user()->update($request->validated());
        if ($request->hasFile('picture')) {
            \Auth::user()->picture = $request->file('picture')->store('profiles', 'public');
            \Auth::user()->save();
        }
        return redirect()->back()->with('success', 'پروفایل شما با موفقیت بروزرسانی شد!');
    }
}
