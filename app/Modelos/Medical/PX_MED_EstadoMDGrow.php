<?php


namespace App\Modelos\Medical;

use Illuminate\Database\Eloquent\Model;

class PX_MED_EstadoMDGrow extends Model
{
    protected $table = 'PX_MED_EstadoMDGrow';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre', 'Descripcion', 'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;

}
