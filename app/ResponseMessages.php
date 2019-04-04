<?php

namespace App;

class ResponseMessages {
    public static function getTicket () {
        return (object) array(
            'success' => array(
                'status' => 200, 
                'message' => "Your car parked successfully"
            ),
            'no_space' => array(
                'status' => 404,
                'message' => "Parking Space not Found"
            ),
            'tech_error' => array(
                'status' => 401,
                'message' => 'Unable to park your car'
            ),
        );
    }

    public static function checkoutTicket () {
        return (object) array(
            'success' => array(
                'status' => 200, 
                'message' => "Ticket Number Found"
            ),
            'no_ticket' => array(
                'status' => 404,
                'message' => "Ticket Number Not Found"
            ),
        );
    }
}
