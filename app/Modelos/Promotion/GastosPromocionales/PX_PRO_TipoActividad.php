<?php

namespace App\Modelos\Promotion\GastosPromocionales;

use Illuminate\Database\Eloquent\Model;

class PX_PRO_TipoActividad extends Model
{
    protected $table = 'PX_PRO_TipoActividad';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre', 'Descripcion', 'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
