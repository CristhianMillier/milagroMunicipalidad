<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    use HasFactory;

    public function tipo_plantilla(){
        return $this->belongsTo(Tipo_plantilla::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function haberes(){
        return $this->hasMany(Habere::class);
    }

    public function descuentos(){
        return $this->hasMany(Descuento::class);
    }

    public function aportes(){
        return $this->hasMany(Aporte::class);
    }

    protected $fillable = ['mes', 'anio', 'monto_haberes', 'monto_descuentos', 'monto_aportes', 'monto_total', 'estado',
        'tipo_plantilla_id', 'user_id'];
}