<?php

namespace App\Modelos\Medical;

use Illuminate\Database\Eloquent\Model;

class PX_MED_ConferencistaBanco extends Model
{
    protected $table = 'PX_MED_ConferencistaBanco';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPersona', 'NombreBanco', 'CodSwiftAba', 'DireccionBanco',
        'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
