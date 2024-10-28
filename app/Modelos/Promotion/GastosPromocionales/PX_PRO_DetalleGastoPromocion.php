<?php

namespace App\Modelos\Promotion\GastosPromocionales;

use Illuminate\Database\Eloquent\Model;

class PX_PRO_DetalleGastoPromocion extends Model
{
    protected $table = 'PX_PRO_DetalleSolicitudGastoPromocion';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdSolicitudGastoPromocion','IdProducto','Unidad',
        'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
