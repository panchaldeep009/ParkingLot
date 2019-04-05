<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\TicketAmount;

class FunctionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        // mktime(hours, , , Day, , )
        
        // echo '\n Asserting Price for 1 hour';
        $expectedAmount = 3;
        $gotAmount = TicketAmount::countAmount(
            mktime(0, 0, 0, 4, 5, 2018), 
            mktime(1, 0, 0, 4, 5, 2018)
        );
        
        // echo '\n Asserting Price for 3 hours';
        $this->assertEquals($gotAmount['total_amount_owe'], $expectedAmount);

        $expectedAmount = 4.5 * 3;
        $gotAmount = TicketAmount::countAmount(
            mktime(0, 0, 0, 4, 5, 2018), 
            mktime(3, 0, 0, 4, 5, 2018)
        );
        
        // echo '\n Asserting Price for 5 hours';
        $this->assertEquals($gotAmount['total_amount_owe'], $expectedAmount);

        $expectedAmount = 6 * 5;
        $gotAmount = TicketAmount::countAmount(
            mktime(0, 0, 0, 4, 5, 2018), 
            mktime(5, 0, 0, 4, 5, 2018)
        );
        
        
        // echo '\n Asserting Price for 7 hours';
        $this->assertEquals($gotAmount['total_amount_owe'], $expectedAmount);

        $expectedAmount = 7.5 * 7;
        $gotAmount = TicketAmount::countAmount(
            mktime(0, 0, 0, 4, 5, 2018), 
            mktime(7, 0, 0, 4, 5, 2018)
        );
        
        $this->assertEquals($gotAmount['total_amount_owe'], $expectedAmount);

        // echo '\n Asserting Price for 13 hours';
        $this->assertEquals($gotAmount['total_amount_owe'], $expectedAmount);

        $expectedAmount = 9 * 13;
        $gotAmount = TicketAmount::countAmount(
            mktime(0, 0, 0, 4, 5, 2018), 
            mktime(13, 0, 0, 4, 5, 2018)
        );
        
        $this->assertEquals($gotAmount['total_amount_owe'], $expectedAmount);

        // echo '\n Asserting Price for 25 hours';
        $this->assertEquals($gotAmount['total_amount_owe'], $expectedAmount);

        $expectedAmount = 10.5 * 25;
        $gotAmount = TicketAmount::countAmount(
            mktime(0, 0, 0, 4, 5, 2018), 
            mktime(1, 0, 0, 4, 6, 2018)
        );
        
        $this->assertEquals($gotAmount['total_amount_owe'], $expectedAmount);
    }
}
