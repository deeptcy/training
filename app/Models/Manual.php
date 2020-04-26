<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
	protected $table = 'manual';
	public $timestamps = false;
   
    /**
    * The attributes that are mass assignable.
    * 
    * @var array   
    */
    protected $fillable = ['manual_title','manual_text','section_order','is_deleted','added_date','last_modified_date'];
}

