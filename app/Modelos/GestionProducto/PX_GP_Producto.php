<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PX_GP_Producto extends Model
{
    protected $table = 'PX_GP_Producto';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdMarca",
        "IdEstatus",
        "IdPaisOrigen",
        "IdFabricante",
        "IdTitular",
        "IdSubFranquicia",
        "Presentacion",
        "PresentacionRegulatorio",
        "TipoPresentacion",
        "VidaUtil",
        "CodigoSap",
        "CodigoBarras",
        "Descripcion",
        "FechaVencimiento",
        "Estado",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps = false;

    public function SubFranquicia()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_SubFranquicia', 'IdSubFranquicia', 'Id');
    }

    public function Marca()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_Marca', 'IdMarca', 'Id');
    }

    public function ModalidadVenta()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_ProductoModalidadVenta', 'IdModalidadVenta', 'Id');
    }

    public function Concentracion()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_ProductoFormaTipo', 'IdProducto', 'Id');
    }

    public function PresentacionTipo()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_ProductoPresentacionTipo', 'IdTipoPresentacion', 'Id');
    }

    public function PX_GP_ProductoCodigos()
    {
        return $this->hasMany('App\Modelos\GestionProducto');
    }
}
