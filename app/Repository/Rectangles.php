<?php

namespace App\Repository;

class Rectangles extends BaseModel
{
    protected $table = 'rectangles';
    protected $fillable = [
      'height',
      'width',
      'avg_speed',
      'marker_count',
      'color',
      'overwrite_user'
    ];
    
    public function markers()
    {
        return $this->hasMany(Markers::class, 'position', 'id');
    }
    
    public function rule()
    {
        return [
          'height' => 'required|min:0|max:22',
          'width' => 'required|min:0|max:55',
        ];
    }
}