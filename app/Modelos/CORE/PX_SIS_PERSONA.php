<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_PERSONA extends Model
{
    protected $table='PX_SIS_PERSONA';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdEntidad','Nombres', 'Apellidos','Genero','FechaCreacion','Estado','FechaIngreso','FechaRetiro');
    public $incrementing = true;
    public $timestamps=false;


    public function Usuario()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_USUARIO','IdPersona','Id');
    }

    public function PersonaContacto()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_PERSONA_CONTACTO','IdPersona','Id');
    }

    public function PersonaContactoFirst()
    {
        return $this->hasOne('App\Modelos\CORE\PX_SIS_PERSONA_CONTACTO','IdPersona','Id');
    }

    public function PersonaIdentidad()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_PERSONA_IDENTIDAD','IdPersona','Id');
    }

    public function Entidad()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_ENTIDAD','IdEntidad','Id');
    }

    public function CuentaAsignada()
    {
        return $this->hasMany('App\Modelos\Finanzas\PX_FIN_AsignacionCuenta','IdPersonaAsigna','Id');

    }

    public function Presupuesto()
    {
        return $this->hasMany('App\Modelos\Finanzas\PX_FIN_Presupuesto','IdResponsable','Id');
    }

    public function CCostoAsignado()
    {
        return $this->hasMany('App\Modelos\Finanzas\PX_FIN_AsignacionCentroCosto','IdPersona','Id');
    }

    public function EventoEduc()
    {
        return $this->hasMany('App\Modelos\Medical\PX_MED_Evento', 'IdResponsable', 'Id');
    }

    public function MontoEducMedica()
    {
        return $this->hasMany('App\Modelos\Medical\MontoEducMedica', 'IdPersona', 'Id');
    }

}
