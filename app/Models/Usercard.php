<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usercard extends Model
{
    use HasFactory;
    protected $table='user_cards';
    protected $guarded=[];

    public function  user(){
        return $this->belongsTo(Usercard::class);
    }
}
