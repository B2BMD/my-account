<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $fillable = ['case_number', 'shipment_provider', 'shipment_tracking_number', 'tracking_history', 'geolocation_id'];
}
