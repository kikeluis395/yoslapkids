<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_estrofa extends Model
{
    use HasFactory;
    protected $table = "tbl_estrofas";
    protected $primaryKey = 'id_estrofa';
    protected $fillable= ['id_cancion', 'estrofa_contenido'];
    
    public function cancion()
    {
        return $this->belongsTo('App\Models\Tbl_cancion');
    }
}