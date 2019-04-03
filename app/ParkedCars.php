<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkedCars extends Model {
    protected $table = 'parked_cars';
    protected $fillable =[
        'car_status', 'ticket_number', 'ticket_created_at', 'paid_amount', 'paid_credit_card'
    ];
    public $timestamps = false;
}
