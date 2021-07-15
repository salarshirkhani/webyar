<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function get() {
        switch (\Auth::user()->type) {
            case 'admin':
                return redirect()->route('dashboard.Admin.index');
            case 'employee':
                return redirect()->route('dashboard.Employee.index');
            case 'customer':
                return redirect()->route('dashboard.Customer.index');
        }
        return redirect()->route('index');
    }
}
