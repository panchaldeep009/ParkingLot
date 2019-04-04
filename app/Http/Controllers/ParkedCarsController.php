<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ParkedCars;
use App\TicketNumber;
use App\TicketAmount;
use App\ResponseMessages;

class ParkedCarsController extends Controller
{
    /// (GET|POST)/tickets
    public function getTicket(){
        $responseMessages = ResponseMessages::getTicket();
        if(ParkedCars::where('car_status', '=', 'parked')->count() < 6){
            $newTicketNumber = TicketNumber::NewTicketNumber();
    
            $newParking = new ParkedCars;
    
            $newParking->car_status = 'parked';
            $newParking->ticket_number = $newTicketNumber;
            $newParking->ticket_created_at = time();
            $newParking->ticket_created_at = time();
            $newParking->paid_amount = 0;
            $newParking->paid_credit_card = 0;
    
            $newParking->save();
    
            if (!empty($newParking->ticket_number)) {
                return response()->json(
                    array('ticket_number' => $newParking->ticket_number),
                    array('available_space' => 6 - ParkedCars::where('car_status', '=', 'parked')->count())
                    + $responseMessages->success
                );
            } else {
                return response()->json($responseMessages->tech_error);
            }
        } else {
            return response()->json($responseMessages->no_space);
        }
    }
    
    /// GET/tickets/{ticket_number}

    public function checkoutTicket($ticket_number){
        $responseMessages = ResponseMessages::checkoutTicket();
        $thisTicket = ParkedCars::where('ticket_number', '=', intval($ticket_number));
        if($thisTicket->exists()){
            $thisTicket = $thisTicket->first();
            return response()->json(TicketAmount::countAmount($thisTicket->ticket_created_at, time()) + $responseMessages->success);
        } else {
            return response()->json($responseMessages->no_ticket);
        }
    }
}
