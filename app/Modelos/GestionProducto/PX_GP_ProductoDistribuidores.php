<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoDistribuidores extends Model
{
    protected $table = 'PX_GP_ProductoDistribuidores';
    protected $primaryKey = "Id";
    protected $fillable = array(
        'IdRegistroSanitario',
        'IdEntidad',
        'UsuarioCreacion',
        'UsuarioModificacion'
    );
    public $incrementing = true;
    public $timestamps = false;

}
