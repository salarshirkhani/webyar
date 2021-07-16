<?php

namespace App\Http\Controllers\dashboard\employee;

use Carbon\Carbon;
use App\Models\Absence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    public function start_work()
    {
        Absence::create([
           'employee_id'=>Auth::id(),
           'date'=>Carbon::today()->format('Y-m-d'),
           'start'=>Carbon::now()->format('h:m:s')
        ]);
        return redirect(route('dashboard.employee.index'));
    }

    public function finish_work()
    {
        $date=Carbon::today()->format('Y-m-d');
        $absence=Absence::setFinish(Auth::id(),$date)->first();
        $absence->update([
            'finish'=>Carbon::now()->format('h:m:s'),
        ]);
//        $absence->update([
//            'hours'=>Carbon::parse($absence->hours)+(Carbon::parse($absence->finish)->diff(Carbon::parse($absence->start)))
//        ]);
        return redirect(route('dashboard.employee.index'));
    }
}
