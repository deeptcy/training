<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Pages; 
use App\Models\Courses; 
use App\Imports\UsersImport;





class CourseController extends Controller
{
	
	var $recordPerPage =20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function courselist()
    {
       // $pages = Pages::all();	
        $Courses = Courses::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get();
	
        return view('courselist', compact('Courses'));
    }
	
	function ajaxcourselist(Request $request){
		$data = $request->all();
		$page =$data['pagination']['page'];	
		$per_page = $data['pagination']['perpage'];	
		if($per_page ==''){
		$per_page =10; }		
		$method='GET';
		$searchArray['per_page']=$per_page;
		$searchArray['page']	=$page;
		
	//$pageNo = 1;
		$questiosData = Courses::select('*');			
		if(@isset($data['query']['coursegeneralSearch'])){
			$searchKey =$data['query']['coursegeneralSearch'];	
			$questiosData = $questiosData->where(function($q) use ($searchKey){
				$q->where('name', 'LIKE', '%' . $searchKey . '%');
		});
		}	
		$sortfield ='id';
		if(@isset($data['sort']['field']) ){
			if(in_array($data['sort']['field'], array('course','id'))){
			$sortfield =$data['sort']['field'];
			}else{ $sortfield  = 'id'; }
		}
		$sortorder ='ASC';
		if(@isset($data['sort']['sort'])){
			$sortorder =$data['sort']['sort'];
		}
		if($page ==1){ $offset = 0; }else{ $offset = $this->recordPerPage*($page-1); }
		$questiosData->where('is_deleted', '=', '0');
		$questiosData->offset($offset);
        $questiosData->limit($this->recordPerPage);
		$questiosData->orderBy($sortfield, $sortorder);
		$questiosData =	$questiosData->get()->toArray();		
		
		$userCount = Courses::select('*');
		if(@isset($data['query']['coursegeneralSearch'])){
			$searchKey =$data['query']['coursegeneralSearch'];	
			$userCount = $userCount->where(function($q) use ($searchKey){
				$q->where('name', 'LIKE', '%' . $searchKey . '%');
		});
		}
		$userCount->where('is_deleted', '=', '0');
		$userCount =$userCount->get();			
		$totalRecord =$userCount->count();	
		
		$resultDataTable['data'] = $questiosData;	
		$resultDataTable['meta']['page'] = $page;
		$resultDataTable['meta']['pages'] = ceil($totalRecord/$per_page);
		$resultDataTable['meta']['perpage'] = $per_page;
		$resultDataTable['meta']['total'] = $totalRecord;
			return json_encode($resultDataTable);
}
	
	


/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function courseadd(Request $request)
    {		$data = $request->all();
			$validator = Validator::make($request->all(), [ 
				'name'=> 'required|min:5', 
				
			]);					
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			$input['name'] =$data['name'];				
			$input['description'] =$data['description'];
						
			$course = Courses::create($input);		
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
    public function editcourse(Request $request)
    {     
		$data = $request->all();
		$validator = Validator::make($request->all(), [ 
				'courseId' => 'required', 
				'name' => 'required|min:5', 
				
			]);					
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			$id = $data['courseId'];

        $Course = Courses::find($id);		
        $Course->name 		=  $request->get('name');
        $Course->description 		=  $request->get('description');		
        
        $Course->save();
      return response(array("status"=>"success", "code"=>200,"data" => $Course));
    }}








public function parseImport(Request $request)
{	$data = $request->all();
    $file     = request()->file('file');	 
	$path = $file->getPathname();	
	$CSVdata = array_map('str_getcsv', file($path));
	$alreadyExistingQuestion = array();
	$duplicateCourses =0;
	$optionLength =0;
	$header_added = $data['header_added'];
	if($header_added =='true'){
		array_shift($CSVdata);
	}

	foreach($CSVdata as $CSVRow){	
			$course = $CSVRow['0'];
			$correctOption =$CSVRow['5'];		
			if(strlen($correctOption)>1){
				$optionLength =1;
			}
		$QuestionRecord = Courses::where('is_deleted', '=', '0')->where('course', '=', $course)->get()->toArray();
		if(count($QuestionRecord)>=1){
			$alreadyExistingQuestion[]= $course;
			$duplicateCourses =1;	
		}
	}
	if($duplicateCourses ==1){
		return response(array("status"=>"fail", "type"=>'duplicate', "code"=>200,"data" => $alreadyExistingQuestion));
	}elseif($optionLength ==1){
		return response(array("status"=>"fail", "type"=>'answerlength', "code"=>200,"data" => $alreadyExistingQuestion));
	}else{	
		
		foreach($CSVdata as $CSVRow){
			$input = array();			
			$input['course'] =$CSVRow['0'];				
			$input['option_a'] =$CSVRow['1'];
			$input['option_b'] =$CSVRow['2'];
			$input['option_c'] =$CSVRow['3'];
			$input['option_d'] =$CSVRow['4'];
			$input['correct_option'] =$CSVRow['5'];					
			$course = Courses::create($input);			
		}		
		return response(array("status"=>"success", "code"=>200,"data" => $course));
	}
}





public function deletecourse(Request $request)
{	$data = $request->all(); 
	$id = $data['courseIdDelete'];
	$Question = Courses::find($id);		
    $Question->is_deleted 		=  1;
    $Question->save();
    return response(array("status"=>"success", "code"=>200,"data" => $Question));	  
}




	
	
}