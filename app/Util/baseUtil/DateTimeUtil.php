<?php

namespace App\Util\baseUtil;

use Carbon\Carbon;
use Illuminate\Support\Facades\Date;

trait DateTimeUtil
{
    public function dataTime(): float|int|string
    {
        return Carbon::now()->toDateTimeString();
    }

    public function timestampParse($time): string
    {
        return  Carbon::parse($time)->format('Y-m-d H:i:s');
    }
    public function createDateFromFormat($date): string
    {

        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y');
    }

    public function addTimestamp($min="", $hr="", $sec=""): \Illuminate\Support\Carbon|string
    {
        $now =  Carbon::now();
        if ($min !==""){
            return $now->addMinute($min)->toDateTimeString();
        }elseif ($hr !==""){
            return $now->addHour($hr)->toDateTimeString();
        }elseif ($sec !==""){
            return $now->addSecond($sec)->toDateTimeString();
        }else{
            return strtotime($now);
        }

    }
    public function toTimestamp($str): bool|int
    {
        return strtotime($str);
    }
}
