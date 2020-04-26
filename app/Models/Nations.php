<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nations extends Model
{
	protected $table = 'nation';
	public $timestamps = false;
   
    /**
    * The attributes that are mass assignable.
    * 
    * @var array   
    */
    protected $fillable = ['nation_code','nation_name','nation_status'];
}