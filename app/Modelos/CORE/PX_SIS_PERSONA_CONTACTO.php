<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_PERSONA_CONTACTO extends Model
{
    protected $table='PX_SIS_CONTACTO';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPersona', 'IdPais','Direccion','Correo','Telefono','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;



    public function Persona()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PERSONA','IdPersona','Id');
    }

    public function Pais()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PAIS','IdPais','Id')->orderBy('Nombre','asc');
    }
}
