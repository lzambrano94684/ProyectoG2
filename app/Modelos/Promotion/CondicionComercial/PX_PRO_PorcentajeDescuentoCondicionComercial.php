<?php


namespace App\Modelos\Promotion\CondicionComercial;

use Illuminate\Database\Eloquent\Model;

class PX_PRO_PorcentajeDescuentoCondicionComercial extends Model
{
    protected $table = 'PX_PRO_PorcentajeDescuentoCondicionComercial';
    protected $primaryKey = 'Id';
    protected $fillable = array('PorcentajeDecuento', 'CIFMinima','DAFMaxima', 'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
