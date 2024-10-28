<?php


namespace App\Modelos\Medical;


use Illuminate\Database\Eloquent\Model;

class PX_MED_EventoMarca extends Model
{
    protected $table = 'PX_MED_EventoMarca';
    protected $primaryKey = 'Id';
    protected $fillable = array('IdEvento', 'IdMarca', 'FechaCreacion',
        'FechaModificacion', 'UsuarioCreacion', 'UsuarioModificacion');
    public $incrementing = true;
    public $timestamps = false;

    //Relacion Marca
    public function Marca(){
        return $this->belongsTo('App\Modelos\GestionProducto\PX_GP_Marca', 'IdMarca', 'Id');
    }

    //Relacion Evento
    public function Evento(){
        return $this->belongsTo('App\Modelos\Medical\PX_MED_Evento','IdEvento','Id');
    }


}
