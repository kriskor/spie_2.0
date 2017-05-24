<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class VariableEstadisticaDimension extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'variables_estadisticas_dimensiones';
}
