<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_FormaFarmaceuticaTipo extends Model
{
    protected $table='PX_GP_FormaFarmaceuticaTipo';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','Descripcion','UsuarioCreacion','UsuarioModificacion');
    public $incrementing = true;
    public $timestamps=false;
}
