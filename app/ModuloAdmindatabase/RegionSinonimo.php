<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class RegionSinonimo extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'regiones_sinonimos';
}
