<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function get() {
        return view('dashboard.admin.index');
    }
}
