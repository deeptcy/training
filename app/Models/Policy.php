<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
	protected $table = 'qms_files';
	public $timestamps = false;
   
    /**
    * The attributes that are mass assignable.
    * 
    * @var array   
    */
    protected $fillable = ['title','qmsdesc','filepath','qmstype','is_active','is_deleted','added_date'];
}

