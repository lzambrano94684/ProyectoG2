<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_GrupoProducto extends Model
{
    protected $table = 'PX_GP_GrupoProducto';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'Nombre',
        'Descripcion',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion'
    );
    public $incrementing = true;
    public $timestamps = false;

}
