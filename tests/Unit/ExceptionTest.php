<?php
use \Tests\TestCase;
use \App\Util\exceptionUtil\ExceptionUtil;

class ExceptionTest extends TestCase
{
    /**
     * @throws ExceptionUtil
     */
    public function test_exception(){
        throw new ExceptionUtil(\App\Util\exceptionUtil\ExceptionCase::SYSTEM_MALFUNCTION);
    }
}
