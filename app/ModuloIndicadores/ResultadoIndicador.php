<?php

namespace App\ModuloIndicadores;

use Illuminate\Database\Eloquent\Model;

class ResultadoIndicador extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'resultado_indicadores';
  protected $primaryKey = 'id_resultado_indicador';
}
