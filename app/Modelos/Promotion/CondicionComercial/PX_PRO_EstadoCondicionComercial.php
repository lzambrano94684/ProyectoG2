<?php


namespace App\Modelos\Promotion\CondicionComercial;


use Illuminate\Database\Eloquent\Model;

class PX_PRO_EstadoCondicionComercial extends Model
{
    protected $table = 'PX_PRO_EstadoSolicitudComercial';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        'Nombre',
        'Codigo',
        'Descripcion',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion');

    public $incrementing = true;
    public $timestamps = false;

}
