<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_PAIS extends Model
{
    protected $table='PX_SIS_PAIS';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre', 'Codigo', 'CodigoBi', 'tipoUso','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;


    public function PersonaContacto()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_PERSONA_CONTACTO','IdPais','Id');
    }

    public function Entidad()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_ENTIDAD','IdPais','Id');
    }

    public function DistProdRegulatorio()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_DistProdRegulatorio','IdPais','Id');
    }

    public function Marca()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_Marca','IdOrigen','Id');
    }

    public function Ventas()
    {
        return $this->hasMany('App\Modelos\CIF\PX_CIF_Ventas', 'IdPaisDestinatario', 'Id');
    }

    public function EventoEduc(){
        return $this->hasMany('App\Modelos\Medical\PX_MED_Evento','IdPais','Id');
    }

    public function MontoEducMedica()
    {
        return $this->hasMany('App\Modelos\Medical\MontoEducMedica', 'IdEspecialidad', 'Id');
    }

    public function Tbl_AsignacionEquipos()
    {
        return $this->hasMany('App\Modelos\Informatica\Tbl_AsignacionEquipos','IdPais','Id');
    }

}
