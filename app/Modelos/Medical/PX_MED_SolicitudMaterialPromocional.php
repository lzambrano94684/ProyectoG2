<?php

namespace App\Modelos\Medical;

use Illuminate\Database\Eloquent\Model;

class PX_MED_SolicitudMaterialPromocional extends Model
{
    protected $table = 'PX_MED_SolicitudMaterialPromocional';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdMaterialPromocional',
        'IdPais',
        'IdFranquicia',
        'IdMarca',
        'IdSolicitante',
        'IdPublicoDirigido',
        'IdEstado',
        'IdEjecucionTipo',
        'IdArbol',
        'IdInicioArbol',
        'Objetivo',
        'DescripcionMaterial',
        'DuracionMaterial',
        'Codigo',
        'FechaSolicitud',
        'URLDocumento',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
