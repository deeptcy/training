<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
	protected $table = 'coupons';
	public $timestamps = false;
   
    /**
    * The attributes that are mass assignable.
    * 
    * @var array   
    */
    protected $fillable = ['code','start_date','end_date','user_type','description','discount','user_id','uses_allowed','discount_type','is_deleted'];
}
