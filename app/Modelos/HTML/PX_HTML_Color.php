<?php

namespace App\Modelos\HTML;

use Illuminate\Database\Eloquent\Model;

class PX_HTML_Color extends Model
{
    protected $table = 'PX_HTML_Color';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "Codigo",
        "FechaCreacion",
        "FechaModificacion",
        "UsuarioCreacion",
        "UsuarioModificacion",

    );
    public $incrementing = true;
    public $timestamps = false;
}
