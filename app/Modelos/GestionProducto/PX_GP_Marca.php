<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PX_GP_Marca extends Model
{
    protected $table='PX_GP_Marca';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdPatologia",
        "IdGrupoTerapeutico",
        "Nombre",
        "URLRegistro",
        "Descripcion",
        "Estado",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps=false;

    public function Producto()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_Producto','IdMarca','Id');
    }

    public function MarcaPrincipioActivo()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_MarcaPrincipioActivo','IdMarca','Id');
    }

    public function InRegistroMarca()
    {
        $modelRegistroMarca = PX_GP_RegistroMarca::select(DB::raw("count(1) cantidad"))->where("IdMarca",$this->Id)->first();
        return $modelRegistroMarca->cantidad;
    }

    public function EventoEduc(){
        return $this->hasMany('App\Modelos\Medical\PX_MED_Evento','IdMarca','Id');
    }


}
