<?php

namespace App\Modelos\GestionProducto;


use Illuminate\Database\Eloquent\Model;

class PX_GP_Planta extends Model
{
    protected $table='PX_GP_Planta';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'Nombre',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion'
    );
    public $incrementing = true;
    public $timestamps=false;
}
