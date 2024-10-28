<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_Departamento extends Model
{
    protected $table='PX_SIS_Departamento';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdEntidad','Nombre','Descripción','Direccion','Telefono','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function DetalleCapex()
    {
        return $this->hasMany('App\Modelos\Finanzas\PX_FIN_DetalleCapex','IdDepartamento','Id');
    }

    public function DetalleOpex()
    {
        return $this->hasMany('App\Modelos\Finanzas\PX_FIN_DetalleOpex','IdDepartamento','Id');
    }

    public function UsuarioPuesto ()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_USUARIO','IdPuesto','Id');
    }

    public function SociedadDepartamento ()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_SociedadDepartamento','IdDepartamento','Id');
    }

    public function Puesto (){
        return $this->hasMany('App\Modelos\CORE\PX_SIS_Puesto','IdDepartamento','Id');
    }

}
