<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Salat extends Model
{
    protected $fillable = [
        'user_id', 'fajr', 'zuhr','asr','maghrib','isha','created'
    ];
}
