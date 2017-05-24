<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class EntidadSinonimo extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'entidades_sinonimos';
}
