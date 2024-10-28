<?php

namespace App\Modelos\VisitaMedica;
use Illuminate\Database\Eloquent\Model;

class MD_UniversoMedico extends Model
{
    protected $table = 'MD_UniversoMedico';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "nombre",
        "CONCAT",
        "localidad",
        "cdg_region",
        "region",
        "Pais",
        "DOMICILIO_UNIFICADO",
        "LOCALIDAD_UNIFICADA",
        "REGI_N_UNIFICADA",
        "cdg_postal",
        "matricula",
        "cdg_esp1",
        "cdg_esp2",
        "rep1",
        "rep2",
        "rep3",
        "rep4",
        "rep5",
        "rep6",
        "rep7",
        "rep8",
        "rep9",
        "rep10",
        "cdg_zonapostal",
        "descripcion",
        "LINEA_PROMO",
        "presentacion",
        "prod",
        "cdg_medico",
        "MEDICO_UNICO",
        "cdg_lider",
        "TRIM_Cat_1",
        "TRIM_Cat_2",
        "TRIM_Cat_3",
        "TRIM_Cat_4",
        "PRECIO",
        "TERAPIA",
        "VALORIZACION",
        "Version",
        "IdPais",
        "FechaCreacion",
        "UsuarioCreacion",
        "FechaModificacion",
        "UsuarioModificacion"

    );
    public $incrementing = true;
    public $timestamps = false;
}
