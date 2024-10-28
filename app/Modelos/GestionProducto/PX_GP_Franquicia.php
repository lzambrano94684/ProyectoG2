<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_Franquicia extends Model
{
    protected $table='PX_GP_Franquicia';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','Descripcion','UsuarioCreacion','UsuarioModificacion');
    public $incrementing = true;
    public $timestamps=false;

    public function DistProdRegulatorio()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_DistProdRegulatorio','IdFranquicia','Id');
    }

    public function subfranquicia()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_ClasFranq','IdFranquicia','Id');
    }

    public function EventoEduc(){
        return $this->hasMany('App\Modelos\Medical\PX_MED_Evento','IdFranquicia','Id');
    }

    public function MontoEducMedica()
    {
        return $this->hasMany('App\Modelos\Medical\MontoEducMedica', 'IdFranquicia', 'Id');
    }

    public function PX_GP_FranquiciaHistorial()
    {
        return $this->hasMany('App\Modelos\GestionProducto\PX_GP_FranquiciaHistorial', 'IdFranquicia', 'Id');
    }

}
