<?php
namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_FranquiciaHistorial extends Model
{
    protected $table='PX_GP_FranquiciaHistorial';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdFranquicia','IdProductoCod','Periodo');
    public $incrementing = true;
    public $timestamps=false;

    Public function AsigProductos()
    {
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_ProductoCodigos','IdProductoCod','Id');
    }
}
