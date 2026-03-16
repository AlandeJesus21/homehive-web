<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;









class PropiedadImagen extends Model
{
    
    
    protected $table = 'propiedad_imagenes';

    
    
    
    protected $fillable = ['propiedad_id', 'ruta'];

    
    public function propiedad()
    {
        return $this->belongsTo(Propiedad::class);
    }
}



