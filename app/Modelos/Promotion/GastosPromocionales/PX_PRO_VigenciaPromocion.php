<?php

namespace App\Modelos\Promotion\GastosPromocionales;

use Illuminate\Database\Eloquent\Model;

class PX_PRO_VigenciaPromocion extends Model
{
    protected $table = 'PX_PRO_VigenciaPromocion';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdSolicitudGastoPromocion','IdVigenciaTipoPromocion','FechaInicio','FechaFin','MontoMensual',
        'Total', 'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
