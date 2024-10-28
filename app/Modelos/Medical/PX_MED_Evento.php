<?php

namespace App\Modelos\Medical;

use Illuminate\Database\Eloquent\Model;

class PX_MED_Evento extends Model
{
    protected $fillable = array('IdFranquicia',
        'IdPais',
        'IdResponsable',
        'IdMetodoPago',
        'IdConferencista',
        'IdDoc',
        'IdArbol',
        'Mes',
        'FechaHoraEvento',
        'CodReg',
        'Ciudad',
        'NombreEvento',
        'Objetivo',
        'LugarEvento',
        'Honorarios',
        'Hospedaje',
        'CantInvitados',
        'CantStaff',
        'CostoPlatoComida',
        'TotalPresupuesto',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion',
        'TipoEvento',
        'Plataforma',
        'Sociedad',
        'IdEstado',

        'IdPresupuesto',
        'IdEjecucionTipo',
        'IdInicioArbol',
        'NombreSpeaker');
    protected $table = 'PX_MED_Evento';
    protected $primaryKey = 'Id';
    public $incrementing = true;
    public $timestamps = false;

    //Relacion Franquica
    public function Franquicia(){
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_Franquicia','IdFranquicia','Id');
    }

    //Relacion Pais
    public function Pais(){
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_Pais', 'IdPais', 'Id');
    }

    //Relación Persona
    public function Persona(){
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PERSONA','IdResponsable','Id');
    }

    public function MetodoPago(){
        return $this->belongsTo('App\Modelos\Medical\PX_MED_MetodoPago','IdMetodoPago','Id');

    }

    public function MontoEducMedical(){
        return $this->belongsTo('App\Modelos\Finanzas\PX_FIN_PresupuestoDetalleSub','IdPresupuesto','Id');
    }


    public function EventoEspecialidad(){
        return $this->hasMany('App\Modelos\Medical\PX_MED_EventoEspecialidad','IdEvento','Id');
    }

    public function EventoMarca(){
        return $this->hasMany('App\Modelos\Medical\PX_MED_EventoMarca','IdEvento','Id');
    }

    public function Conferencista(){
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PERSONA','IdConferencista','Id');
    }

    public function convertDate($tipo)
    {
        $FechaHoraEvento = $this->FechaHoraEvento;
        $FechaHoraEvento = str_replace(substr($FechaHoraEvento,-7), "",$FechaHoraEvento);
        return collect(explode(" ",$FechaHoraEvento));
    }
}
