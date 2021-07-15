<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use Morilog\Jalali\CalendarUtils;

trait DateTrait{

    public function convert_to_georgian($persian)
    {
        $date_string=explode('-',$persian);
        $georgian=CalendarUtils::toGregorian($date_string[0],$date_string[1],$date_string[2]);
        return Carbon::create($georgian[0],$georgian[1],$georgian[2]);
   }
}
