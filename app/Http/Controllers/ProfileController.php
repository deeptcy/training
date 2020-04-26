<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Pages; 
use App\Models\Books; 
use App\Models\Nations; 
use App\Models\Courses;
use App\User;
use Auth;

use Redirect,Response,File;

class ProfileController extends Controller
{
	
	var $recordPerPage =20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myprofile(Request $request)
    {   
		$user = auth()->user();
		$userId = $user->id;
		$User = User::where('id', '=', $userId)->orderBy('id', 'ASC' )->get()->toArray();
		$Nation = Nations::where('nation_status', '=', 1)->orderBy('id', 'ASC' )->get()->toArray();
	
		$fullpath = public_path('/userimage/');
	
        return view('myprofile',['User' => $User[0], 'fullpath' => $fullpath, 'Nation' => $Nation] );
    }
	
	
	
	
	function updateprofile(Request $request){
	
		$data = $request->all();
		/*
		  $this->validate($request, [
            'name' => 'required|min:5',
			   'profile_avatar' => 'image|mimes:jpeg,png,jpg,gif,JPEG,PNG,JPG,GIF',           
        ]);
		
		
		request()->validate([
		  'name' => 'required|min:5',
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
		*/
		  $this->validate($request, [
            'name' => 'required|min:5',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			
        ]);
		
		
		
		     

		$inputUserData = array();
		
        $inputUserData['name'] 		=  $data['name'];
        $inputUserData['phone'] 		=   $data['phone']; 
		$inputUserData['nation_code'] 		=   $data['nation_code'];
		$inputUserData['dob'] 		=   $data['dob'];
		if($files=$request->file('profile_avatar')){
			$name=$files->getClientOriginalName();			
			$name = time().'.'.$files->getClientOriginalExtension(); 
			$destinationPath = public_path('/userimage/');
			$files->move($destinationPath, $name);
			 $inputUserData['photo_path'] 		=   $name;
		}	
		
	
		 $user = Auth::user();
        $user->update($inputUserData);
		return back()->with('message', '<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Indicates a successful or positive action.
</div>');   
		
		/*
		return back()->withErrors(['msg', '<div class="alert alert-success alert-dismissible">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Success!</strong> Indicates a successful or positive action.
</div>']);*/
}
	
	


/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function bookadd(Request $request)
    {		$data = $request->all();
			$validator = Validator::make($request->all(), [ 
				'name'=> 'required|min:5', 
				
			]);	
			
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			$input['name'] =$data['name'];
			$input['couse_id'] =$data['couseid'];				
			$input['description'] =$data['description'];
						
			$book = Books::create($input);		
			return response(array("status"=>"success", "code"=>200,"data" => $data));
		}	
       
    }


   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editbook(Request $request)
    {     
		$data = $request->all();
		$validator = Validator::make($request->all(), [ 
				'bookId' => 'required', 
				'name' => 'required|min:2', 
				
			]);					
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			$id = $data['bookId'];

        $Book = Books::find($id);		
        $Book->name 		=  $request->get('name');
        $Book->description 		=  $request->get('description');	
        $Book->couse_id 		=  $request->get('couseid');		
        $Book->save();
      return response(array("status"=>"success", "code"=>200,"data" => $Book));
    }}








public function parseImport(Request $request)
{	$data = $request->all();
    $file     = request()->file('file');	 
	$path = $file->getPathname();	
	$CSVdata = array_map('str_getcsv', file($path));
	$alreadyExistingQuestion = array();
	$duplicateBooks =0;
	$optionLength =0;
	$header_added = $data['header_added'];
	if($header_added =='true'){
		array_shift($CSVdata);
	}

	foreach($CSVdata as $CSVRow){	
			$book = $CSVRow['0'];
			$correctOption =$CSVRow['5'];		
			if(strlen($correctOption)>1){
				$optionLength =1;
			}
		$QuestionRecord = Books::where('is_deleted', '=', '0')->where('book', '=', $book)->get()->toArray();
		if(count($QuestionRecord)>=1){
			$alreadyExistingQuestion[]= $book;
			$duplicateBooks =1;	
		}
	}
	if($duplicateBooks ==1){
		return response(array("status"=>"fail", "type"=>'duplicate', "code"=>200,"data" => $alreadyExistingQuestion));
	}elseif($optionLength ==1){
		return response(array("status"=>"fail", "type"=>'answerlength', "code"=>200,"data" => $alreadyExistingQuestion));
	}else{	
		
		foreach($CSVdata as $CSVRow){
			$input = array();			
			$input['book'] =$CSVRow['0'];				
			$input['option_a'] =$CSVRow['1'];
			$input['option_b'] =$CSVRow['2'];
			$input['option_c'] =$CSVRow['3'];
			$input['option_d'] =$CSVRow['4'];
			$input['correct_option'] =$CSVRow['5'];					
			$book = Books::create($input);			
		}		
		return response(array("status"=>"success", "code"=>200,"data" => $book));
	}
}





public function deletebook(Request $request)
{	$data = $request->all(); 
	$id = $data['bookIdDelete'];
	$Question = Books::find($id);		
    $Question->is_deleted 		=  1;
    $Question->save();
    return response(array("status"=>"success", "code"=>200,"data" => $Question));	  
}




	
	
}