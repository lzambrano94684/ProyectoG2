<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoFormaTipo extends Model
{
    protected $table = 'PX_GP_ProductoFormaTipo';
    protected $primaryKey = "Id";
    protected $fillable = array(
        'IdProducto',
        'IdFormaFarmaceutica',
        'IdFormaFarmaceuticaTipo',
        'DescripcionSap',
        'UsuarioCreacion',
        'UsuarioModificacion'
    );
    public $incrementing = false;
    public $timestamps = false;

    public function FormaFarmaceuticaTipo()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_FormaFarmaceuticaTipo', 'IdFormaFarmaceuticaTipo', 'Id');
    }

    public function FormaFarmaceutica()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_FormaFarmaceutica', 'IdFormaFarmaceutica', 'Id');
    }

    public function ProductoFirs()
    {
        return $this->hasOne('App\Modelos\GestionProducto\PX_GP_Producto','Id','IdProducto');
    }

}
