<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_SubFranquicia extends Model
{
    protected $table='PX_GP_SubFranquicia';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdFranquicia',
        'Nombre',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion'
    );
    public $incrementing = true;
    public $timestamps=false;

}
