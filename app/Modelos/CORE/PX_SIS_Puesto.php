<?php


namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_Puesto extends Model
{
    protected $table='PX_SIS_Puesto';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdDepartamento',
        'Nombre',
        'Descripción',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps=false;

//    public function Puesto()
//    {
//        return $this->belongsTo('App\Modelos\CORE\PX_SIS_Departamento','IdDepartamento','Id');
//    }
    public function Usuario()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_USUARIO','IdPuesto','Id');
    }
    public function Departamento (){
        return $this->hasMany('App\Modelos\CORE\PX_SIS_Departamento','Id','IdDepartamento');
    }

}
