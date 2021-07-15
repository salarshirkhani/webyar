<?php

namespace App\Http\Controllers\dashboard\employee;

use Carbon\Carbon;
use App\Models\Absence;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AbsenceController extends Controller
{
    public function start_work($id)
    {
        Absence::create([
           'employee_id'=>$id,
           'date'=>Carbon::today()->format('Y-m-d'),
           'start'=>Carbon::now()->format('h:m:s')
        ]);
    }

    public function finish_work($id)
    {
        $date=Carbon::today()->format('Y-m-d');
        $absence=Absence::setFinish($id,$date);
        $absence->update([
            'finish'=>Carbon::now()->format('h:m:s')
        ]);
    }
}
