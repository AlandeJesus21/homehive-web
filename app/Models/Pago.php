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

    /**
     * Casts para asegurar que las fechas sean objetos Carbon 
     * y el monto mantenga sus decimales.
     */
    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin'    => 'datetime',
        'monto'        => 'decimal:2'
    ];

    /**
     * Relación con la propiedad pagada
     */
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }

    /**
     * Relación principal con el usuario (inquilino)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Alias para 'user' 
     * Mantenemos este para no romper SolicitudController ni las vistas antiguas
     */
    public function inquilino()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relación con el arrendador (el dueño que recibe el dinero)
     */
    public function arrendador()
    {
        return $this->belongsTo(User::class, 'arrendador_id');
    }
}