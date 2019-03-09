<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
class QuestionAnswer extends Model
{
    protected $fillable = [
        'user_id','question'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
