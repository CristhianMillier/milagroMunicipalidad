<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    public function cargo(){
        return $this->belongsTo(Cargo::class);
    }

    public function regimene(){
        return $this->belongsTo(Regimene::class);
    }

    public function contrato(){
        return $this->belongsTo(Contrato::class);
    }

    public function habere(){
        return $this->belongsTo(Habere::class);
    }

    public function descuento(){
        return $this->belongsTo(Descuento::class);
    }

    public function aporte(){
        return $this->belongsTo(Aporte::class);
    }
    
    protected $fillable = ['nombre', 'dni', 'sistema_pension', 'tipo_sistema_pension', 'cusp', 
        'fecha_nacimiento', 'fecha_ingreso', 'dias_laboral', 'cargo_id', 'regimene_id', 'contrato_id'];
}