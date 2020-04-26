<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Pages; 





class QmsController extends Controller
{
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function qms()
    {
      
      
	
        return view('qms');
    }
	 





	
	
}