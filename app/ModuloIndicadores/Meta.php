<?php

namespace App\ModuloIndicadores;

use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'metas';
}
