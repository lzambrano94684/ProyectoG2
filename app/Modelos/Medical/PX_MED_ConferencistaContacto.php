<?php

namespace App\Modelos\Medical;

use Illuminate\Database\Eloquent\Model;

class PX_MED_ConferencistaContacto extends Model
{
    protected $table = 'PX_MED_ConferencistaContacto';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPersona', 'IdPais', 'IdEspecialidad', 'Direccion', 'DocIdentificacion',
        'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
