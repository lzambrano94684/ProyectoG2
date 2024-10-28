<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PX_GP_RegistroMarcaPresentacion extends Model
{
    protected $table='PX_GP_RegistroMarcaPresentacion';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'Id',
        'IdRegistroMarca',
        'IdProducto',
        'UsuarioCreacion'
    );
    public $incrementing = true;
    public $timestamps=false;

    public function RegistroMarca()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_RegistroMarca','IdRegistroMarca','Id');
    }

    public function Producto()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_Producto','IdProducto','Id');
    }
}
