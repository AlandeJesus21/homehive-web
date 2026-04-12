<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Review extends Model
{   use HasFactory;
    protected $fillable = [
        'propiedad_id',
        'user_id',
        'rating',
        'comentario'
    ];
    protected $casts = [
        'rating' => 'integer',
    ];
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }



}
