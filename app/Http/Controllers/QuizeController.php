<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Pages; 
use App\Models\Books; 
use App\Models\Courses;



class QuizeController extends Controller
{
	
	 
    public function quize()
    {
       // $pages = Pages::all();	
      //  $Books = Books::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get();
	
	
	        $Courses = Courses::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get()->toArray();
	
        return view('onlinequize', ['Courses' => $Courses] );
    }	
	
}