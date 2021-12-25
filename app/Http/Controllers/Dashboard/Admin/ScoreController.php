<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\ScoreCreateRequest;
use App\Http\Requests\Dashboard\Admin\ScoreUpdateRequest;
use App\Http\Requests;
use App\Models\Score;
use App\Models\User;

class ScoreController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.score.index', ['scores' => Score::orderBy('created_at', 'desc')->get()]);
    }

    public function create()
    {
        return view('dashboard.admin.score.create', ['users' => User::all()]);
    }

    public function store(ScoreCreateRequest $request)
    {
        $score = new Score($data = $request->validated());
        $score->user()->associate($data['user_id']);
        $score->save();
        return redirect()->route('dashboard.admin.score.index')->with('info', 'امتیاز ایجاد شد!');
    }

    public function edit(Score $score)
    {
        return view('dashboard.admin.score.edit', ['score' => $score]);
    }

    public function update(ScoreUpdateRequest $request, Score $score)
    {
        $score->update($request->validated());
        $score->save();
        return redirect()->route('dashboard.admin.score.index')->with('info', 'امتیاز ویرایش شد!');
    }

    public function destroy(Score $score) {
        $score->delete();
        return redirect()->route('dashboard.admin.score.index')->with('info', 'امتیاز حذف شد!');
    }

}
