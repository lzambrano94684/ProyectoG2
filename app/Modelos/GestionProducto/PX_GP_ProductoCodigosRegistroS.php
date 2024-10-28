<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_ProductoCodigosRegistroS extends Model
{
    protected $table='PX_GP_ProductoCodigosRegistroS';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'IdProductoCodigo',
        'IdRegistroSanitario',
        'Observacion',
        'UsuarioCreacion',
        'UsuarioModificacion'
    );
    public $incrementing = true;
    public $timestamps=false;

}
