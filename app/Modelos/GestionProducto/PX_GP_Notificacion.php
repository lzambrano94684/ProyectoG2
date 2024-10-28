<?php

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_Notificacion extends Model
{
    protected $table='PX_GP_Notificacion';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'Nombre',
        'Descripcion',
        'Correos',
        'Mes',
        'Repeticiones'
    );
    public $incrementing = true;
    public $timestamps=false;

}
