<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_DescontinuadoAlert extends Model
{
    protected $table = 'PX_GP_DescontinuadoAlert';
    protected $primaryKey = 'Id';
    protected $fillable = array('Correo');
    public $incrementing = true;
    public $timestamps = false;

}
