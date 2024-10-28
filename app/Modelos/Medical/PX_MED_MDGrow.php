<?php

namespace App\Modelos\Medical;

use Illuminate\Database\Eloquent\Model;

class PX_MED_MDGrow extends Model
{

    protected $table = 'PX_MED_MDGrow';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdEspecialidad',
        'IdPais',
        'IdEstadoGrow',
        'Nombre',
        'Apellido',
        'Genero',
        'CodigoArea',
        'Celular',
        'Telefono',
        'Correo',
        'NoColegiado',
        'DireccionConsultorio',
        'TelConsultorio',
        'CartaFirmada',
        'ConsultorioListo',
        'FechaConsultorio',
        'ConsultasAcumuladas',
        'EncuestaSatisfaccion',
        'Observaciones',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}
