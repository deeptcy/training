<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
	protected $table = 'course_books';
	public $timestamps = false;
   
    /**
    * The attributes that are mass assignable.
    * 
    * @var array   
    */
    protected $fillable = ['name','course_id','type','description','is_deleted','bookpath'];
}
