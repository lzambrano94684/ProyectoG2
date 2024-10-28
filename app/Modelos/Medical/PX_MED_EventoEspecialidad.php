<?php


namespace App\Modelos\Medical;


use Illuminate\Database\Eloquent\Model;

class PX_MED_EventoEspecialidad extends Model
{
    protected $table = 'PX_MED_EventoEspecialidad';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdEvento', 'IdEspecialidad', 'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;

    //Relación Especialidad Médica

    public function Especialidad(){
        return $this->belongsTo('App\Modelos\Medical\PX_MED_EspecialidadMedico','IdEspecialidad','Id');
    }

    //Relacion Evento
    public function Evento(){
        return $this->belongsTo('App\Modelos\Medical\PX_MED_Evento','IdEvento','Id');
    }

}
