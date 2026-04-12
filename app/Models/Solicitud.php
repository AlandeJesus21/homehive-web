<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{   protected $table = 'solicituds';
    protected $fillable = ['propiedad', 'precio', 'estatus', 'curp', 'user_id','edad', 'ocupacion', 'fecha', 'telefono', 'mensaje'];

    public function usuario() {
    return $this->belongsTo(User::class, 'user_id');
}
}

