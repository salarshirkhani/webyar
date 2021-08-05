<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function get() {
        switch (\Auth::user()->type) {
            case 'admin':
                return redirect()->route('dashboard.admin.index');
            case 'employee':
                return redirect()->route('dashboard.employee.task.manage');
            case 'customer':
                return redirect()->route('dashboard.customer.index');
        }
        return redirect()->route('index');
    }
}
