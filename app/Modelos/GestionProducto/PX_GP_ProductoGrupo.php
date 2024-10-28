<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoGrupo extends Model
{
    protected $table = 'PX_GP_ProductoGrupo';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdMarca',
        'IdProducto',
        'IdGrupo',
        'FechaCreacion',
        'UsuarioCracion'
    );
    public $incrementing = true;
    public $timestamps = false;

}
