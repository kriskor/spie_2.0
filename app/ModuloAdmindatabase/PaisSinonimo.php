<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class PaisSinonimo extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'paises_sinonimos';
}
