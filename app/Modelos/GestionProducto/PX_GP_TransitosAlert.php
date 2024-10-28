<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_TransitosAlert extends Model
{
    protected $table='PX_GP_TransitosAlert';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPersona','UsuarioCreacion', 'UsuarioModificacion','FechaCreacion', 'FechaModificacion');
    public $incrementing = true;
    public $timestamps=false;

}
