<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_RegistroSanitarioPresentacion extends Model
{
    protected $table = 'PX_GP_RegistroSanitarioPresentacion';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdRegistroSanitario",
        "IdPresentacionRegulatorio",
        "UsuarioCreacion",
        "UsuarioModificacion"
    );
    public $incrementing = true;
    public $timestamps = false;

}
