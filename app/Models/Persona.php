<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'persona_id';
    protected $fillable= ['nombres', 'apellidos', 'edad', 'sexo', 'celular', 'tipo_persona'];
    
}
