<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'regiones';
}
