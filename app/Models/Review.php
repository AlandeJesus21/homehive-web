<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Review extends Model
{
    protected $fillable = [
        'propiedad_id',
        'user_id',
        'rating',
        'comentario'
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
