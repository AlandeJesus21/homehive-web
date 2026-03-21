<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppReview extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'rating', 'comentario'];

    // Relación con el usuario que hizo la reseña
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}