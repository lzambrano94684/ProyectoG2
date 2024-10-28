<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_PERFIL extends Model
{
    protected $table='PX_SIS_PERFIL';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function PerfilUsuario()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_PERFIL_USUARIO','IdPerfil','Id')->orderBy('Nombre','asc');
    }

    public function PerfilModulo()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_PERFIL_MODULO','IdPerfil','Id');
    }

    public function PerfilMenu()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_PERFIL_MENU','IdPerfil','Id');
    }

    public function PerfilSubMenu()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_PERFIL_SUB_MENU','IdPerfil','Id');
    }

    public function PerfilModuloId()
    {
        $sql = $this->hasMany('App\Modelos\CORE\PX_SIS_PERFIL_MODULO','IdPerfil','Id')
            ->select("IdModulo")
            ->get();
        return $sql;
    }



}
