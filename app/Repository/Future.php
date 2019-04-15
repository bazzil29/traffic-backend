<?php

namespace App\Repository;

class Future extends BaseModel
{
    protected $table = 'future';
    protected $fillable = [
      'height',
      'width',
      'destination_time',
      'id_cell',
      'avg_speed',
      'color'
    ];
    
    // public function markers()
    // {
    //     return $this->hasMany(Markers::class, 'position', 'id');
    // }
    
    // public function rule()
    // {
    //     return [
    //       'height' => 'required|min:0|max:22',
    //       'width' => 'required|min:0|max:55',
    //     ];
    // }
}