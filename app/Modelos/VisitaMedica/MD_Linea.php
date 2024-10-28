<?php


namespace App\Modelos\VisitaMedica;


use Illuminate\Database\Eloquent\Model;

class MD_Linea extends Model
{
    protected $table = 'MD_Linea';
    protected $primaryKey = 'Id';
    protected $fillable = array(
        "Nombre"
    );
    public $incrementing = true;
    public $timestamps = false;
}
