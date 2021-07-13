<?php

namespace App\Http\Controllers\Dashboard\Employee;


use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function get() {
        return view('dashboard.employee.index');
    }
}
