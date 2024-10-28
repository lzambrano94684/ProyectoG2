<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoPresentacionTipo extends Model
{
    protected $table='PX_GP_ProductoPresentacionTipo';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','Descripcion','UsuarioCreacion','UsuarioModificacion');
    public $incrementing = true;
    public $timestamps=false;

}
