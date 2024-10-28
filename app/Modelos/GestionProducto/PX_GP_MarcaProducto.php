<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_MarcaProducto extends Model
{
    protected $table='PX_GP_MarcaProducto';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdProducto','IdMarca','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Producto()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_Producto','IdProducto','Id');
    }

    public function Marca()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_Marca','IdMarca','Id');
    }
}
