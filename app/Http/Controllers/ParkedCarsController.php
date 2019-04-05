<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ParkedCars;
use App\TicketNumber;
use App\TicketAmount;
use App\ResponseMessages;
use Validator;

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
            $newParking->paid_amount = 0;
    
            $newParking->save();
    
            if (!empty($newParking->ticket_number)) {
                return response()->json(
                    array('ticket_number' => $newParking->ticket_number) +
                    array('available_space' => 6 - ParkedCars::where('car_status', '=', 'parked')->count()) +
                    $responseMessages->success
                );
            } else {
                return response()->json(
                    $responseMessages->tech_error
                );
            }
        } else {
            return response()->json(
                $responseMessages->no_space
            );
        }
    }
    
    /// GET/tickets/{ticket_number}

    public function checkoutTicket($ticket_number){
        $responseMessages = ResponseMessages::checkoutTicket();
        $thisTicket = ParkedCars::where('ticket_number', '=', intval($ticket_number));
        if($thisTicket->exists() && $ticket_number != ''){
            $thisTicket = $thisTicket->first();
            return response()->json(
                [ "car_status" => $thisTicket->car_status ] +
                TicketAmount::countAmount($thisTicket->ticket_created_at, 
                    $thisTicket->car_status == "paid" ? 
                        $thisTicket->paid_at :
                        time() 
                ) + $responseMessages->success
            );
        } else {
            return response()->json(
                $responseMessages->no_ticket
            );
        }
    }

    /// POST/payments/{ticket_number}

    public function payForTicket($ticket_number, Request $request){

        $validator = Validator::make($request->all(), [
            "credit_card" => "required|min:16|max:16",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "status" => 400,
                "error" => $validator->errors(),
            ], 400);
        }
        $responseMessages = ResponseMessages::payForTicket();
        $thisTicket = ParkedCars::where('ticket_number', intval($ticket_number));
        if($thisTicket->exists() && $ticket_number != ''){
            if($thisTicket->first()->car_status != 'paid'){
                $thisTicket->update([
                    "car_status" => 'paid',
                    "paid_amount" => TicketAmount::countAmount($thisTicket->first()->ticket_created_at, time())['total_amount_owe'],
                    "paid_credit_card" => $request->credit_card,
                    "paid_at" => time(),
                ]);
            }
            return response()->json($responseMessages->success);
        } else {
            return response()->json($responseMessages->no_ticket);
        }
    }
}
