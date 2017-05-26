<?php

namespace App\ModuloIndicadores;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'resultados';
}
