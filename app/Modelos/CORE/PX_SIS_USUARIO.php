<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_USUARIO extends Model
{
    protected $table='PX_SIS_USUARIO';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPersona', 'Usuario', 'Clave', 'FechaCreacion', 'IdPuesto', 'FechaBaja','Estado');
    public $incrementing = true;
    public $timestamps=false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function TipoUsuario()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_TIPO_USUARIO','IdTipoUsuario','Id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Persona()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PERSONA','IdPersona','Id');
    }

    public function RolesUsuario()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_ROLES_USUARIO','IdUsuario','Id');
    }

    public function Puesto()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_Puesto','Id','IdPuesto');
    }
//    public function Departamento ()
//    {
//        return $this->belongsTo('App\Modelos\CORE\PX_SIS_Departamento','IdDepartamento','Id');
//    }
}
