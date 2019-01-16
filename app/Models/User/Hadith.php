<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Hadith extends Model
{
    protected $fillable = [
        'user_id','description', 'source'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }


}
