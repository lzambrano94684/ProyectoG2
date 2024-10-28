<?php

namespace App\Modelos\Medical;

use Illuminate\Database\Eloquent\Model;

class PX_MED_Pais extends Model
{
    protected $table = 'PX_MED_Pais';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdEvento', 'IdPais', 'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;

}
