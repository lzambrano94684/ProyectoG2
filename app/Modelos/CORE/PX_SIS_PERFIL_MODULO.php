<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_PERFIL_MODULO extends Model
{
    protected $table='PX_SIS_PerfilModulo';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPerfil', 'IdModulo','FechaCreacion','FechaModificacion');
    public $incrementing = true;
    public $timestamps=false;

    public function Perfil()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PERFIL','IdPerfil','Id');
    }

    public function Modulo()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_MODULO','IdModulo','Id');
    }
}
