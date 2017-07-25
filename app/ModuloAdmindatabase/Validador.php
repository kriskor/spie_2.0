<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class Validador extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'validadores';
  public $timestamps = false;
}
