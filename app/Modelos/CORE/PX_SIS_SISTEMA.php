<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_SISTEMA extends Model
{
    protected $table='PX_SIS_SISTEMA';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','Descripcion','Icono','Imagen','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Modulo()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_MODULO','IdSistema','Id')->orderBy('Nombre','asc');
    }


}
