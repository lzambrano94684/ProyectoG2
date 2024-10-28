<?php


namespace App\Modelos\Promotion\CondicionComercial;
use Illuminate\Database\Eloquent\Model;

class PX_PRO_TipoCondicionComercial extends Model
{
    protected $table = 'PX_PRO_TipoCondicionComercial';
    protected $primaryKey = 'Id';
    protected $fillable = array('Nombre', 'Descripcion', 'FechaCreacion', 'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;
}



