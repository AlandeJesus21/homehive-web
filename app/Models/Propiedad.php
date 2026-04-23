<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Propiedad extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'propiedades';

    
protected $fillable = [
    'user_id',
    'titulo',
    'tipo',
    'barrio_id', 
    'calle',
    'latitud',
    'longitud',
    'precio',
    'forma_pago',
    'servicio',
    'descripcion',
    'reglas',
    'cercanias',
];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    
    public function imagenes()
    {
        return $this->hasMany(PropiedadImagen::class, 'propiedad_id');
    }

    public function barrio() 
    {
        
        return $this->belongsTo(Barrio::class, 'barrio_id'); 
    }

    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'propiedad_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'propiedad_id');
    }

    public function favoritos()
    {
        return $this->belongsToMany(Propiedad::class, 'favoritos');
    }
}