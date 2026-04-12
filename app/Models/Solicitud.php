<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes'; 

    protected $fillable = [
        'propiedad_id',
        'user_id',
        'estado',  
        
    ];

    public function propiedad()
    {
        
        return $this->belongsTo(Propiedad::class, 'propiedad_id');
    }

    public function aspirante()
    {
        
        return $this->belongsTo(User::class, 'user_id');
    }
}