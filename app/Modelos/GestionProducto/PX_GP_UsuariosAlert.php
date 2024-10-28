<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_UsuariosAlert extends Model
{
    protected $table='PX_GP_UsuariosAlert';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPersona');
    public $incrementing = true;
    public $timestamps=false;

    public function Persona()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_Persona','IdPersona','Id');
    }

}
