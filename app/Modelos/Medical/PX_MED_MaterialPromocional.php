<?php

namespace App\Modelos\Medical;

use Illuminate\Database\Eloquent\Model;

class PX_MED_MaterialPromocional extends Model
{
    protected $table = 'PX_MED_MaterialPromocional';
    protected $primaryKey = 'Id';
    protected $fillable = array('Codigo', 'Descripcion',
        'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
