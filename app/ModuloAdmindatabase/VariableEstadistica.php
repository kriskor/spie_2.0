<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class VariableEstadistica extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'variables_estadisticas';
}
