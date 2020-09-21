<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpanishWord extends Model
{
  protected $guarded = ['id'];
  public function miqEspRelation()
  {
    return $this->hasMany('miqEspRelation');
  }
}
