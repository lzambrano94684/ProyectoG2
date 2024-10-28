<?php

namespace App;

namespace App\Modelos\GestionProducto;

use Illuminate\Database\Eloquent\Model;

class PX_GP_MarketAccessAlert extends Model
{
    protected $table = 'PX_GP_MarketAccessAlert';
    protected $primaryKey = 'Id';
    protected $fillable = array('Correo');
    public $incrementing = true;
    public $timestamps = false;

}
