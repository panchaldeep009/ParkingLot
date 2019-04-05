<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\ParkedCars;

class APITest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $totalCarParked = ParkedCars::where('car_status', '=', 'parked')->count();
        $response = $this->json('POST', '/api/tickets');

        if($totalCarParked < 6){
            
            $exceptedResponse = [
                'status' => 200, 
                'message' => "Your car parked successfully"
            ];
            $checkKeys = ['ticket_number'];
        } else {

            $exceptedResponse = [
                'status' => 404,
                'message' => "Parking Space not available"
            ];
            $checkKeys = [];
        }

        $response->assertJsonFragment($exceptedResponse);

        foreach ($checkKeys as $key) {
            $this->assertArrayHasKey($key, json_decode($response->content(), true));
        }


        $exceptedResponse = [
            'status' => 404,
            'message' => "Ticket Number Not Found"
        ];
    
        $this->json('GET', '/api/tickets/123456')
            ->assertJsonFragment($exceptedResponse);
    
        $exampleRow = ParkedCars::first();
    
        $checkKeys = [
            "car_status",
            "total_time_parked",
            "total_time_parked_unix",
            "total_charged_hours",
            "total_amount_owe",
            "message",
            "additional_amount_chared_per_hour",
            "status",
        ];
        
        $response = $this->json('GET', '/api/tickets/'.$exampleRow->ticket_number);
        
        foreach ($checkKeys as $key) {
            $this->assertArrayHasKey($key, json_decode($response->content(), true));
        }

        $exceptedResponse = [
            "status" => 400,
        ];
    
        $this->json('POST', '/api/payments/'. $exampleRow->ticket_number)
            ->assertJsonFragment($exceptedResponse);
    
        $exceptedResponse = [
            "status" => 200,
            "message" => "Payment successful"
        ];
    
        $this->json('POST', '/api/payments/'. $exampleRow->ticket_number, ['credit_card' => 1234567890123456])
            ->assertJsonFragment($exceptedResponse);   
    }
}
