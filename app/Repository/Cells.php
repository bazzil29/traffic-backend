<?php

namespace App\Repository;

class Cells extends BaseModel
{
    protected $table = 'cells';
    protected $fillable = [
      'height',
      'width',
      'east',
      'west',
      'north',
      'south'
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