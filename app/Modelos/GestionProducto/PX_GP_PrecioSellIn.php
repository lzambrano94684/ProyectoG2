<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_PrecioSellIn extends Model
{

    protected $table = 'PX_GP_PrecioSellIn';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'SKUSAP', 'NombreSAP', 'IdPais', 'Monto', 'IdMoneda', 'IdPlanta', 'EstatusPromocion', 'Origen', 'SKUPadre'
    , 'NombrePadre', 'IdIncoterm',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion'
    );
    public $incrementing = true;
    public $timestamps = false;
}
