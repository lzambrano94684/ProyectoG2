<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_RegistroSanitarioFormaFarTipo extends Model
{
    protected $table = 'PX_GP_RegistroSanitarioFormaFarTipo';
    protected $primaryKey = "Id";
    protected $fillable = array(
        'IdRegistroSanitario',
        'IdFormaFarmaceuticaTipo',
        'UsuarioCreacion',
    );
    public $incrementing = true;
    public $timestamps = false;

}
