<?php

namespace App\Repository;

class Markers extends BaseModel
{
    protected $table = 'markers';
    protected $fillable = [
      'lat',
      'lng',
      'speed',
      'position',
      'record_user',
      'record_time'
    ];
}