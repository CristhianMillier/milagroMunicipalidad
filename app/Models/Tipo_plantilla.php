<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_plantilla extends Model
{
    use HasFactory;

    public function plantillas(){
        return $this->hasMany(Plantilla::class);
    }

    protected $fillable = ['nombre'];
}