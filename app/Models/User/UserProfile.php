<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id', 'gender', 'division','address','contact','details','education','image','dob'
    ];
    protected $primaryKey = "user_id";
}
