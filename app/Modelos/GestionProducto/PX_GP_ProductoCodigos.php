<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoCodigos extends Model
{
    protected $table='PX_GP_ProductoCodigos';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdProducto',
        'CodigoSap',
        'DescripcionSap',
        'Estado',
        'UsuarioCreacion',
        'UsuarioModificacion'
    );
    public $incrementing = true;
    public $timestamps=false;

    Public function AsigProductos()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_Producto','IdProducto','Id');
    }
}
