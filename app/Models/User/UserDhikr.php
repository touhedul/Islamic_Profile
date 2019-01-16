<?php

namespace App\Models\User;

use App\Models\Admin\Dhikr;
use Illuminate\Database\Eloquent\Model;

class UserDhikr extends Model
{
    protected $fillable = [
        'user_id', 'dhikr_id', 'dhikr_count'
    ];

    public function dhikrs($dhikr_id){

        return Dhikr::find($dhikr_id);
    }
}
