<?php


namespace App\Modelos\Promotion\CondicionComercial;

use Illuminate\Database\Eloquent\Model;

class PX_PRO_ListaPrecio extends Model
{
    protected $table = 'PX_PRO_ListaPrecio';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdPais',
        'IdCondicionComercial',
        'IdProductoCodigo',
        'IdOrigienLista',
        'Precio',
        'FechaCreacion',
        'FechaModificacion',
        'UsuarioCreacion',
        'UsuarioModificacion');

    public $incrementing = true;
    public $timestamps = false;
}
