<?php


namespace App\Modelos\Promotion\CondicionComercial;

use Illuminate\Database\Eloquent\Model;

class PX_PRO_SolicitudCondicionComercial extends Model{
    protected $table = 'PX_PRO_SolicitudCondicionComercial';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdDistribuidor',
        'IdPais',
        'IdDoc',
        'IdProductoCodigo',
        'IdVerificacion',
        'IdOrigenLista',
        'IdEstadoCondicion',
        'FechaInicio',
        'FechaFin',
        'IdPersona',
        'IdArbol',
        'IdArbolInicio',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
