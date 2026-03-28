<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;

    
    protected $table = 'propiedades';

    
    
    protected $fillable = [
        'user_id',      
        'titulo',       
        'tipo',         
        'barrio',
        'calle',
        'latitud',      
        'longitud',     
        'precio',
        'forma_pago',   
        'servicio',     
        'descripcion',
        'reglas',
        'cercanias',    
        'imagen',       
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    
    public function imagenes()
    {
        return $this->hasMany(PropiedadImagen::class, 'propiedad_id');
    }
}