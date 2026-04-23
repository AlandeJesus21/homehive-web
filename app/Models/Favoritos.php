<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Propiedad;


class Favoritos extends Model
{
    protected $table = 'favorites';

    protected $fillable = [
        'id',
        'user_id',
        'propiedad_id',
    ];

    // Define relaciones si es necesario

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }
}
