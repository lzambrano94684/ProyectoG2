<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PX_GP_GrupoTerapeutico extends Model
{
    protected $table='PX_GP_GrupoTerapeutico';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'Id',
        "Nombre",
        "Descripcion",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps=false;

}
