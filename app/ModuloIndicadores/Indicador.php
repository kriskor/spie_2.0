<?php

namespace App\ModuloIndicadores;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
  protected $table = 'mi_indicadores';
  protected $primaryKey = 'id_indicador';
}
