<?php

namespace App;

use App\Repository\Rectangles;
use App\Repository\Markers;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'name',
      'email',
      'password',
      'img',
      'phone',
      'address',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'password',
      'remember_token',
    ];
    
    /**
     * Rule for edit and register
     * @return array
     */
    public function rule(){
        return [
          'name' => 'required|min:3|max:191',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:6|max:191',
          'img' => 'max:191',
          'phone' => 'max:30',
          'address' => 'max:191'
        ];
    }
    
    public function ruleLogin(){
        return [
          'email' => 'required|email',
          'password' => 'required|min:6|max:100',
        ];
    }
    
}
