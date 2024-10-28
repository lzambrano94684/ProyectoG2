<?php


namespace App\Modelos\Promotion\CondicionComercial;

use Illuminate\Database\Eloquent\Model;

class PX_PRO_DetalleSolicitudCondicionComercial extends Model
{
    protected $table = 'PX_PRO_DetalleSolicitudCondicionComercial';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdSolicitudCondicion',
        'IdTipoCondicion',
        'IdPrecio',
        'IdPorcentajeDescuento',
        'Unidades',
        'UnidadesBonificacion',
        'IdentificadorVenta',
        'PrecioUnitario',
        'CostoBonificacionPais',
        'PrecioCif',
        'PrecioDaf',
        'PrecioCompetencia',
        'PrecioCifSugerido',
        'PrecioCifAprobado',
        'ObservacionComercial',
        'ObservacionFinanciera',
        'FechaPrecioSugerido',
        'UsuarioAsignaPrecioSugerido',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion');

    public $incrementing = true;
    public $timestamps = false;
}
