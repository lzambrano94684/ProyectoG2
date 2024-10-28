<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Fichero extends Model
{
    protected $table = 'MD_Fichero';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "IdRepresentante",
        "Colegiado",
        "NombreLargo",
        "EspPromoRegilla",
        "EspecialidadPrimaria",
        "IdUniversoM",
        "EspecialidadSecundaria",
        "Frecuencia",
        "Mail1",
        "Cat",
        "CruceAuditoria",
        "CodigoAuditoria",
        "Direccion",
        "Depto",
        "Municipio",
        "Tipo",
        "Version",
        "Activo",
        "SolicitudActivo",
        "IdEstatusFichero",
        "InstitucionVinculada",
        "CantidadDependientesFAR",
        "NivelSocioeconomico",
        "PosibilidadColocarStandMarcasFarmacia",
        "Justificacion",
        "JustificacionBaja",
        "Potencialidad",
        "TipoDomicilio",
        "PerfilActutidinal",
        "Afinidad",
        "CodCloseUp",
        "Localidad",
        "Region",
        "UsuarioCreacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
