<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'entidades';
}
