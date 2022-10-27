<?php
namespace Tests\Unit;

use App\Util\baseUtil\RandomUtil;
use Exception;
use Tests\TestCase;

class RandomTest extends TestCase
{
    use RandomUtil;

    /**
     * @throws Exception
     */
    public function test_otp()
    {
        $random = $this->OTP();
        dd($random);
    }

    public function test_random_string()
    {
        $random = $this->RANDOM_STRING();
        dd($random);
    }

    public function test_username()
    {
        $random = $this->USERNAME("Morahthank@gmail.com");
        dd($random);
    }
}
