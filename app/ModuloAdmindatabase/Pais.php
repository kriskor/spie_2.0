<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'paises';
  public $timestamps = false;
}
