<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallApiCounter extends Model
{
    use HasFactory;

    protected $fillable = ['api_provider', 'date', 'counter'];
}
