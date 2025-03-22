<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    public function personas(){
        return $this->hasMany(Persona::class);
    }
    
    protected $fillable = ['nombre'];
}