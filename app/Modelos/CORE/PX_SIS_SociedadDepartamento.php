<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_SociedadDepartamento extends Model
{
    protected $table = 'PX_SIS_Sociedad_Departamento';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdEntidad','IdDepartamento','FechaCreacion','FechaModificacion','UsuarioCreacion','UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;


    public function Monto()
    {
        return $this->hasMany('App\Modelos\Finanzas\PX_FIN_Monto','IdSociedadDepartamento','Id');
    }

    public function Departamento ()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_ENTIDAD','IdEntidad','Id');
    }

    public function Sociedad ()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_Departamento','IdDepartamento','Id');
    }

}
