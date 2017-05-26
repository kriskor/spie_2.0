<?php

namespace App\ModuloIndicadores;

use Illuminate\Database\Eloquent\Model;

class Pilar extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'pilares';
}
