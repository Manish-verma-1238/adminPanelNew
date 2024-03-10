<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Api\Vendor;

class VendorLoginDetail extends Model
{
    use HasFactory;
    protected $table = 'vendor_login_details';

    protected $fillable = [
        'vendor_id', 'phone', 'otp', 'device_type',  'device_token'
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
