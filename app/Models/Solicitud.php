<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

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

    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }

    public function datosPropiedad()
    {
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }

    public function aspirante()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}