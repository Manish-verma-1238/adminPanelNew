<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'bookings';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'booking_unique_id',
        'status',
        'trip',
        'source',
        'stops',
        'destination',
        'price',
        'paid_price_percentage',
        'balance_price',
        'passengers',
        'bags',
        'name',
        'email',
        'mobile',
        'alternate_no',
        'gst_no',
        'ride_date',
        'ride_time',
    ];
}
