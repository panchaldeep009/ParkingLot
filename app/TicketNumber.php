<?php

namespace App;

use App\ParkedCars;

class TicketNumber {
    public static function NewTicketNumber () {
        $TicketNumber = rand(100000,999999);
        while (ParkedCars::where('ticket_number', '=', $TicketNumber)->exists()) {
            $TicketNumber = rand(100000,999999);
        }
        return $TicketNumber;
    }
}
