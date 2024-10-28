<?php

namespace App\Modelos\GestionProducto;

use App\Http\Controllers\BaseController;
use Illuminate\Database\Eloquent\Model;

class PX_GP_RegistroMarca extends Model
{
    protected $table = 'PX_GP_RegistroMarca';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdMarca",
        "IdPaisComercializacion",
        "IdTitular",
        "IdNotificacion",
        "IdEstatus",
        "NoRegistro",
        "FechaVencimiento",
        "Folio",
        "Libro_Tomo",
        "URLRegistro",
        "Descripcion",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps = false;

    public function ProductoFormaTipoFirs()
    {
        return $this->hasOne('App\Modelos\GestionProducto\PX_GP_ProductoFormaTipo','Id','IdProductoFormaTipo');
    }

    public function validaStatus()
    {
        $baseControler = new BaseController();
        return $baseControler->RegistroMarcaEstatus()->get($this->IdEstatus);
    }

    public function fechaVencimientoCorrect()
    {
        $fechaDecode = null;
        if ($this->FechaVencimiento){
            $fecha = explode("-",$this->FechaVencimiento);
            $fechaDecode = "$fecha[2]/$fecha[1]/$fecha[0]";
        }
        return $fechaDecode;
    }
}
