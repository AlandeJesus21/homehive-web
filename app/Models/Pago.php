<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $fillable = [
        'propiedad_id',
        'inquilino_id',
        'monto',
        'estado',
        'fecha_pago'
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }

    public function inquilino()
    {
        return $this->belongsTo(User::class, 'inquilino_id');
    }
}
