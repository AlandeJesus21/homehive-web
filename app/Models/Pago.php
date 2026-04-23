<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = [
        'propiedad_id',
        'user_id',
        'arrendador_id',
        'monto',
        'fecha_inicio',
        'fecha_fin',
        'stripe_id',
        'status',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin'    => 'datetime',
        'monto'        => 'decimal:2'
    ];

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function inquilino()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function arrendador()
    {
        return $this->belongsTo(User::class, 'arrendador_id');
    }
}