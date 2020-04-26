<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Pages; 
use App\Models\Manuals; 
use App\Models\Courses;



class ManualController extends Controller
{
	
	var $recordPerPage =20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function manuallist()
    {
       // $pages = Pages::all();	
      //  $Manuals = Manuals::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get();
	
	
	        $Courses = Courses::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get()->toArray();
	
        return view('manuallist', ['Courses' => $Courses] );
    }
	
	public function manualdetail(Request $request, $id)
    {
      //$ManualData = Manuals::where('is_deleted', '=', '0')->where('id', '=', $id)->get()->toArray();
	  
	  $ManualData = Manuals::select('course_manuals.id as id','courses.name as cname','course_manuals.description','type','course_manuals.name','course_id','manualpath');	
	  
		$ManualData->leftJoin('courses', function ($join) {
            $join->on('courses.id', '=', 'course_manuals.course_id');
			});
		$ManualData->where('course_manuals.id', '=', $id);
		$ManualData =	$ManualData->get()->toArray();	
	
		$Manual =  $ManualData[0];
        return view('manualdetail', compact('Manual'));
    }
	
	function ajaxmanuallist(Request $request){
		$data = $request->all();
		$page =$data['pagination']['page'];	
		$per_page = $data['pagination']['perpage'];	
		if($per_page ==''){
		$per_page =10; }		
		$method='GET';
		$searchArray['per_page']=$per_page;
		$searchArray['page']	=$page;
		
	//$pageNo = 1;
		$questiosData = Manuals::select('course_manuals.id as id','courses.name as cname','course_manuals.description','course_manuals.name','course_id','manualpath');			
		if(@isset($data['query']['manualgeneralSearch'])){
			$searchKey =$data['query']['manualgeneralSearch'];	
			$questiosData = $questiosData->where(function($q) use ($searchKey){
				$q->where('name', 'LIKE', '%' . $searchKey . '%')
				->orWhere('description', 'LIKE', '%' . $searchKey . '%')
				->orWhere('cname', 'LIKE', '%' . $searchKey . '%')
				->orWhere('course_id', 'LIKE', '%' . $searchKey . '%');
		});
		}	
		$sortfield ='id';
		if(@isset($data['sort']['field']) ){
			if(in_array($data['sort']['field'], array('name','description','id','cname'))){
			$sortfield =$data['sort']['field'];
			}else{ $sortfield  = 'id'; }
		}
		$sortorder ='ASC';
		if(@isset($data['sort']['sort'])){
			$sortorder =$data['sort']['sort'];
			
		}
		
		$questiosData->leftJoin('courses', function ($join) {
            $join->on('courses.id', '=', 'course_manuals.course_id');
			});
		
		
		if($page ==1){ $offset = 0; }else{ $offset = $this->recordPerPage*($page-1); }
		$questiosData->where('course_manuals.is_deleted', '=', '0');
		$questiosData->offset($offset);
        $questiosData->limit($this->recordPerPage);
		$questiosData->orderBy($sortfield, $sortorder);
		$questiosData =	$questiosData->get()->toArray();		
		
		$userCount = Manuals::select('*');
		if(@isset($data['query']['manualgeneralSearch'])){
			$searchKey =$data['query']['manualgeneralSearch'];	
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
    public function manualadd(Request $request)
    {		$data = $request->all();
			$validator = Validator::make($request->all(), [ 
				'name'=> 'required|min:5', 
				'file' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
			]);	
			
			
			
			
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			
			if($files=$request->file('file')){
			$name=$files->getClientOriginalName();			
			$name = time().'.'.$files->getClientOriginalExtension(); 
			$destinationPath = public_path('/coursemanuals/');
			$files->move($destinationPath, $name);
			 $input['manualpath'] 		=   $name;
			}	
		
			
			
			//  $file     = request()->file('file');	 manualpath 
	//$path = $file->getPathname();	
	
	
			  // $imageName = time().'.'.request()->image->getClientOriginalExtension();

  

       // request()->image->move(public_path('images'), $imageName);
		
		
			$input['name'] =$data['name'];
			$input['course_id'] =$data['courseid'];				
			$input['description'] =$data['description'];
						
			$manual = Manuals::create($input);		
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
    public function editmanual(Request $request)
    {     
		$data = $request->all();
		$validator = Validator::make($request->all(), [ 
				'manualId' => 'required', 
				'name' => 'required|min:2', 
				
			]);					
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			$id = $data['manualId'];

        $Manual = Manuals::find($id);	
			
				if($files=$request->file('file')){
			$name=$files->getClientOriginalName();			
			$name = time().'.'.$files->getClientOriginalExtension(); 
			$destinationPath = public_path('/coursemanuals/');
			$files->move($destinationPath, $name);
			$Manual->manualpath 		=   $name;
			}	
			
				
        $Manual->name 		=  $request->get('name');
        $Manual->description 		=  $request->get('description');	
        $Manual->course_id 		=  $request->get('courseid');		
        $Manual->save();
      return response(array("status"=>"success", "code"=>200,"data" => $Manual));
    }}








public function parseImport(Request $request)
{	$data = $request->all();
    $file     = request()->file('file');	 
	$path = $file->getPathname();	
	$CSVdata = array_map('str_getcsv', file($path));
	$alreadyExistingQuestion = array();
	$duplicateManuals =0;
	$optionLength =0;
	$header_added = $data['header_added'];
	if($header_added =='true'){
		array_shift($CSVdata);
	}

	foreach($CSVdata as $CSVRow){	
			$manual = $CSVRow['0'];
			$correctOption =$CSVRow['5'];		
			if(strlen($correctOption)>1){
				$optionLength =1;
			}
		$QuestionRecord = Manuals::where('is_deleted', '=', '0')->where('manual', '=', $manual)->get()->toArray();
		if(count($QuestionRecord)>=1){
			$alreadyExistingQuestion[]= $manual;
			$duplicateManuals =1;	
		}
	}
	if($duplicateManuals ==1){
		return response(array("status"=>"fail", "type"=>'duplicate', "code"=>200,"data" => $alreadyExistingQuestion));
	}elseif($optionLength ==1){
		return response(array("status"=>"fail", "type"=>'answerlength', "code"=>200,"data" => $alreadyExistingQuestion));
	}else{	
		
		foreach($CSVdata as $CSVRow){
			$input = array();			
			$input['manual'] =$CSVRow['0'];				
			$input['option_a'] =$CSVRow['1'];
			$input['option_b'] =$CSVRow['2'];
			$input['option_c'] =$CSVRow['3'];
			$input['option_d'] =$CSVRow['4'];
			$input['correct_option'] =$CSVRow['5'];					
			$manual = Manuals::create($input);			
		}		
		return response(array("status"=>"success", "code"=>200,"data" => $manual));
	}
}





public function deletemanual(Request $request)
{	$data = $request->all(); 
	$id = $data['manualIdDelete'];
	$Question = Manuals::find($id);		
    $Question->is_deleted 		=  1;
    $Question->save();
    return response(array("status"=>"success", "code"=>200,"data" => $Question));	  
}


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response  manualpath
     */
    public function manualdownload(Request $request,$manualpath)
    {
        $file = '../public/coursemanuals/'.$manualpath;
        $name = basename($file);
        return response()->download($file, $name);
      
    }
	

	
	
}