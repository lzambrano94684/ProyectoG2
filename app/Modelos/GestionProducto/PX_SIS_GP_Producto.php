<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_SIS_GP_Producto extends Model
{
    protected $table='PX_GP_Producto';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','IdEstadoProd','Descripcion','FechaMod','FechaDesarrollo','Comentarios','FechaCreacion','Estado');
    public $incrementing = true;
    public $timestamps=false;

    public function Artes()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_SIS_GP_Artes','IdProducto','Id');
    }

    public function DistProdRegulatorio()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_SIS_GP_DistProdRegulatorio','IdProducto','Id');
    }

    public function MarcaProducto()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_SIS_GP_MarcaProducto','IdProducto','Id');
    }

    public function RegistroSanitario()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_SIS_GP_RegistroSanitario','IdProducto','Id');
    }

    public function EstadoProducto(){
        return $this->belongsTo( 'App\Modelos\GestionProducto\PX_SIS_GP_EstadoProducto', 'IdEstadoProd','Id');
    }

}
