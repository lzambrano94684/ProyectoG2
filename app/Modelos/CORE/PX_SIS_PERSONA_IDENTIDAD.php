<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_PERSONA_IDENTIDAD extends Model
{
    protected $table='PX_SIS_PERSONA_IDENTIDAD';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPersona', 'CUI','NIT','IGSS','Pasaporte','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Persona()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PERSONA','IdPersona','Id');
    }

}
