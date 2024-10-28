<?php

namespace  App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_RegulatorioEntidad extends Model
{
    protected $table='PX_GP_RegulatorioEntidad';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre','Descripcion');
    public $incrementing = true;
    public $timestamps=false;
}
