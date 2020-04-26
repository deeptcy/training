<?php
namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Policy; 

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;

class FrontController extends Controller
{
    


	function index(){
		
		$Policy = Policy::where('is_deleted', '=', '0')->where('qmstype', '=', 'POLICY')->orderBy('id', 'desc' )->limit(1)->get()->toArray();		
		$fileName =$Policy[0]['filepath'];
		$destinationPath = public_path('/policydouments/');
		$destinationPath = $destinationPath.$fileName;
		$fileData = chunk_split(base64_encode(file_get_contents($destinationPath))); 
		 $data = array(
            'fileData'=>$fileData,
            'Description'=>'This is New Application',
            'author'=>'foo'
            );

	return view('welcome')->with($data);
				
	}
	
	
		
}