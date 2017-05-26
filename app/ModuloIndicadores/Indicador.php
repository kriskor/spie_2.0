<?php

namespace App\ModuloIndicadores;

use Illuminate\Database\Eloquent\Model;

class Indicador extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'indicadores';
  protected $primaryKey = 'id_indicador';
}
