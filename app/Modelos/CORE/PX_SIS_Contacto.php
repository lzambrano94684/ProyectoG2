<?php

namespace App\Modelos\CORE;

use App\Http\Controllers\BaseController;
use Illuminate\Database\Eloquent\Model;

class PX_SIS_Contacto extends Model
{
    protected $table='PX_SIS_Contacto';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdPersona',
        'IdPais',
        "Dirreccion",
        "Correo",
        "Telefono",
        "FechaCreacion",
        "Estado"
    );
    public $incrementing = true;
    public $timestamps=false;
}
