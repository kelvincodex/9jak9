<?php

use App\Util\baseUtil\DateTimeUtil;
use Tests\TestCase;

class DateTimeTest extends TestCase
{
    use DateTimeUtil;

    public function test_timestamp(){
        dd($this->timestamp());

    }
    public function test_timestamp_parse(){
        dd($this->timestampParse(1665835232));
    }

    public function test_add_timestamp(){
        dd($this->addTimestamp(min:"10"));
    }
    public function test_to_timestamp(){
        dd($this->toTimestamp("2022-10-15 11:53:49"));
    }
}
