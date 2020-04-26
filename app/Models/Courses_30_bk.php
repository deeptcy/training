<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
	protected $table = 'courses';
	public $timestamps = false;
   
    /**
    * The attributes that are mass assignable.
    * 
    * @var array   
    */
    protected $fillable = ['name','description','is_deleted'];
}
