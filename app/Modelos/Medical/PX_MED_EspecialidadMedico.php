<?php

namespace App\Modelos\Medical;

use Illuminate\Database\Eloquent\Model;

class PX_MED_EspecialidadMedico extends Model
{
    protected $table = 'PX_MED_EspecialidadMedico';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre', 'Descripcion', 'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;


    public function EventoEduc()
    {
        return $this->hasMany('App\Modelos\Medical\PX_MED_Evento', 'IdEspecialidad', 'Id');
    }


}
