<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_TercerizadosAlert extends Model
{
    protected $table = 'PX_GP_TercerizadosAlert';
    protected $primaryKey = 'Id';
    protected $fillable = array('Correo');
    public $incrementing = true;
    public $timestamps = false;

}
