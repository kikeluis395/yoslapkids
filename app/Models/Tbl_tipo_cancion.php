<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_tipo_cancion extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_tipo_canciones';
    protected $primaryKey = 'id_tipo_cancion';
    protected $fillable= ['tipo_cancion_nombre'];
    
    public function canciones()
    {
        return $this->hasMany('App\Models\Tbl_cancion', 'id_tipo_cancion', 'id_tipo_cancion');
    }
}