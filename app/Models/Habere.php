<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habere extends Model
{
    use HasFactory;

    public function personas(){
        return $this->hasMany(Persona::class);
    }

    public function plantillas(){
        return $this->belongsTo(Plantilla::class);
    }

    protected $fillable = ['nombre', 'monto', 'fecha_hora', 'persona_id', 'plantilla_id'];
}