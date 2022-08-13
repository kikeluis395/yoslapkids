<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_cancion extends Model
{
    use HasFactory;
    protected $table = "tbl_canciones";
    protected $primaryKey = 'id_cancion';
    protected $fillable= ['tipo_cancion_nombre', 'cancion_titulo', 'id_tipo_cancion', 'cancion_nota', 'cancion_numero_estrofas'];

    public function estrofas()
    {
        return $this->hasMany('App\Models\Tbl_estrofa', 'id_cancion', 'id_cancion');
    }

    public function tipo()
    {
        return $this->belongsTo('App\Models\Tbl_tipo_cancion', 'id_tipo_cancion', 'id_tipo_cancion');
    }
}