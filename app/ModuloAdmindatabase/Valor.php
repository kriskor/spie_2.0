<?php

namespace App\ModuloAdmindatabase;

use Illuminate\Database\Eloquent\Model;

class Valor extends Model
{
  protected $connection = 'dbestadistica';
  protected $table = 'valores';
  public $timestamps = false;
}
