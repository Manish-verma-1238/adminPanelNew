<?php

namespace App\Utils;

class CommonUtils
{
    public static function BookingIdgenerate()
    {
        // Define characters pool for the booking ID
        // $characters = '0123456789';
        // substr(str_shuffle($characters), 0, 6)

        // Generate a random booking ID by shuffling the characters pool and taking a substring
        $bookingId = 'ZIPZAP' . now()->format('mdHis');

        return $bookingId;
    }
}