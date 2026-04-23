<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    // Se mantiene el nombre de la tabla tal cual está en tu base de datos del VPS
    protected $table = 'solicituds'; 

    protected $fillable = [
        'user_id',
        'propiedad_id',
        'propiedad',
        'precio',
        'estatus',  
        'curp',
        'edad',
        'ocupacion',
        'fecha',
        'telefono',
        'mensaje',
    ];

    /**
     * Relación con la propiedad (Nombre estándar)
     */
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }

    /**
     * Alias para la relación con la propiedad
     * Necesario para el filtrado en SolicitudController
     */
    public function datosPropiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }

    /**
     * Relación con el inquilino que envía la solicitud
     */
    public function aspirante()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}