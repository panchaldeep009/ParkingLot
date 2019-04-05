<?php

namespace App;

class TicketAmount {
    public static function countAmount ($unix_time_stamp, $current_unix_time_stamp) {
        $unix_duration = $current_unix_time_stamp - $unix_time_stamp;
        $hours = ($unix_duration/3600);
        $minutes = ($unix_duration%3600/60);
        $seconds = (($unix_duration%3600)%60);
        
        $price_per_hour = 3;
        $additional_price_per_hour = $price_per_hour/2;

        $total_amount_owe = 0;
        $total_amount_owe = ceil($hours)*$price_per_hour;
        $multiplier = 0;
        
        while($hours > floor(3 * (2 ** ($multiplier - 1)))){
            $total_amount_owe += ceil($hours) * $additional_price_per_hour;
            $multiplier++;
        }

        $total_amount_owe = round($total_amount_owe, 2);

        return array(
            'total_time_parked' => floor($hours).':'.floor($minutes).':'.floor($seconds),
            'total_time_parked_unix' => $unix_duration,
            'total_charged_hours' => ceil($hours),
            'total_amount_owe' => $total_amount_owe,
            'message' => "Your have Parked for "
                            .ceil($hours)
                            ." Hours",
            'additional_amount_chared_per_hour' => ($multiplier) * $additional_price_per_hour,
        );
    }
}
