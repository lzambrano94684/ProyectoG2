<?php

namespace App\Modelos\Promotion\GastosPromocionales;

use Illuminate\Database\Eloquent\Model;

class PX_PRO_SolicitudGastoPromocion extends Model
{
    protected $table = 'PX_PRO_SolicitudGastoPromocion';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPersona','IdPais','DescTipoActividad','DescripcionActividad','FechaActividad',
        'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
