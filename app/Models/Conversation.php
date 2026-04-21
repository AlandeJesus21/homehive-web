<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'user_one_id',
        'user_two_id',
        'property_id',
        'last_message'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_one_id');
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_two_id');
    }
    
    public static function between($user1, $user2)
    {
        return self::where(function ($q) use ($user1, $user2) {
            $q->where('user_one_id', $user1)
              ->where('user_two_id', $user2);
        })->orWhere(function ($q) use ($user1, $user2) {
            $q->where('user_one_id', $user2)
              ->where('user_two_id', $user1);
        })->first();
    }


}
