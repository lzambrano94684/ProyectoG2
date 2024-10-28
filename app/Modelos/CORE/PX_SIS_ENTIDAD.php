<?php

namespace App\Modelos\CORE;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_ENTIDAD extends Model
{
    protected $table='PX_SIS_ENTIDAD';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdPais',
        'CodigoCliente',
        'CodigoProveedor',
        'Nombre',
        'NombreBIXDB',
        'NombreBI',
        'NombreSap',
        'Descripcion',
        'RazonSocial',
        'Representante',
        'Direccion',
        'Telefono',
        'Correo',
        'Estado',
        'UsuarioCreacion',
        'UsuarioModificacion',
        'Tipo'
    );
    public $incrementing = true;
    public $timestamps=false;


    public function Persona()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_PERSONA','IdEntidad','Id');
    }

    public function Pais()
    {
        return $this->belongsTo('App\Modelos\CORE\PX_SIS_PAIS','IdPais','Id');
    }


    public function DistProdRegulatorioFab()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_DistProdRegulatorio','IdFabricante','Id');
    }

    public function DistProdRegulatorioFig()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_DistProdRegulatorio','IdFiguraLegal','Id');
    }

    public function DistribuidorProducto()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_DistribuidorProducto','IdDistribuidor','Id');
    }

    public function Presupuesto()
    {
        return $this->hasMany('App\Modelos\Finanzas\PX_SIS_ENTIDAD','IdEntidad','Id');
    }

    public function CentroCosto()
    {
        return $this->hasMany('App\Modelos\Finanzas\PX_FIN_Centro_Costo','IdEntidad','Id');
    }


    public function SociedadDepartamento ()
    {
        return $this->hasMany('App\Modelos\CORE\PX_SIS_SociedadDepartamento','IdEntidad','Id');
    }

}
