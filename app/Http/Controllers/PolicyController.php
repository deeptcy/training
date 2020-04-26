<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Pages; 
use App\Models\Policy; 
use App\Models\Courses;



class PolicyController extends Controller
{
	
	var $recordPerPage =20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function policylist()
    {
       
	    $Policy = Policy::where('is_deleted', '=', '0')->where('qmstype', '=', 'POLICY')->orderBy('id', 'ASC' )->get()->toArray();	
        return view('policylist', ['Policy' => $Policy] );
    }
	
	public function policydetail(Request $request, $id)
    {
      //$PolicyData = Policys::where('is_deleted', '=', '0')->where('id', '=', $id)->get()->toArray();
	  
	  $PolicyData = Policys::select('course_policys.id as id','courses.name as cname','course_policys.description','type','course_policys.name','course_id','policypath');	
	  
		$PolicyData->leftJoin('courses', function ($join) {
            $join->on('courses.id', '=', 'course_policys.course_id');
			});
		$PolicyData->where('course_policys.id', '=', $id);
		$PolicyData =	$PolicyData->get()->toArray();	
	
		$Policy =  $PolicyData[0];
        return view('policydetail', compact('Policy'));
    }
	
	function ajaxpolicylist(Request $request){ 
		$data = $request->all();
		$page =$data['pagination']['page'];	
		$per_page = $data['pagination']['perpage'];	
		if($per_page ==''){
		$per_page =10; }		
		$method='GET';
		$searchArray['per_page']=$per_page;
		$searchArray['page']	=$page;
		
	//$pageNo = 1;
		$questiosData = Policy::select('id','title','qmsdesc','filepath');			
		if(@isset($data['query']['policygeneralSearch'])){
			$searchKey =$data['query']['policygeneralSearch'];	
			$questiosData = $questiosData->where(function($q) use ($searchKey){
				$q->where('title', 'LIKE', '%' . $searchKey . '%')
				->orWhere('qmsdesc', 'LIKE', '%' . $searchKey . '%');
		});
		}	
		$sortfield ='id';
		if(@isset($data['sort']['field']) ){
			if(in_array($data['sort']['field'], array('title','qmsdesc','id','cname'))){
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

		$userCount = Policy::select('*');
		if(@isset($data['query']['policygeneralSearch'])){
			$searchKey =$data['query']['policygeneralSearch'];	
			$userCount = $userCount->where(function($q) use ($searchKey){
				$q->where('title', 'LIKE', '%' . $searchKey . '%');
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
    public function policyadd(Request $request)
    {		$data = $request->all();
			$validator = Validator::make($request->all(), [ 
				'title'=> 'required|min:5', 
				//'file' => 'sometimes|image|mimes:jpeg,png,jpg,pdf,gif,svg|max:2048',
				"file" => "required|mimes:pdf|max:10000",
			]);	
			
			
			
			
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			
			if($files=$request->file('file')){
			$name=$files->getClientOriginalName();			
			$name = time().'.'.$files->getClientOriginalExtension(); 
			$destinationPath = public_path('/policydouments/');
			$files->move($destinationPath, $name);
			 $input['filepath'] 		=   $name;
			}	
		
			$input['title'] =$data['title'];
			$input['qmstype'] ='POLICY';
			$input['qmsdesc'] =$data['qmsdesc'];				
			//$input['description'] =$data['description']; 						
			$policy = Policy::create($input);		
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
    public function editpolicy(Request $request)
    {     
		$data = $request->all();
		if($files=$request->file('file')){
			$validator = Validator::make($request->all(), [ 
					'policyId' => 'required', 
					'title' => 'required|min:2', 
					"file" => "nullable|mimes:pdf|max:10000",				
				]);		
		}else{
				$validator = Validator::make($request->all(), [ 
				'policyId' => 'required', 
				'title' => 'required|min:2', 			
			]);	
		}			
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			
			
			$id = $data['policyId'];

            $Policy = Policy::find($id);	
			
			
			if($files=$request->file('file')){
				$name=$files->getClientOriginalName();			
				$name = time().'.'.$files->getClientOriginalExtension(); 
				$destinationPath = public_path('/policydouments/');
				$files->move($destinationPath, $name);
				$Policy->filepath 		=   $name;
			}	
		
			
				
        $Policy->title 		=  $request->get('title');
        $Policy->qmsdesc 		=  $request->get('qmsdesc');	       
        $Policy->save();
      return response(array("status"=>"success", "code"=>200,"data" => $Policy));
    }}








public function parseImport(Request $request)
{	$data = $request->all();
    $file     = request()->file('file');	 
	$path = $file->getPathname();	
	$CSVdata = array_map('str_getcsv', file($path));
	$alreadyExistingQuestion = array();
	$duplicatePolicys =0;
	$optionLength =0;
	$header_added = $data['header_added'];
	if($header_added =='true'){
		array_shift($CSVdata);
	}

	foreach($CSVdata as $CSVRow){	
			$policy = $CSVRow['0'];
			$correctOption =$CSVRow['5'];		
			if(strlen($correctOption)>1){
				$optionLength =1;
			}
		$QuestionRecord = Policys::where('is_deleted', '=', '0')->where('policy', '=', $policy)->get()->toArray();
		if(count($QuestionRecord)>=1){
			$alreadyExistingQuestion[]= $policy;
			$duplicatePolicys =1;	
		}
	}
	if($duplicatePolicys ==1){
		return response(array("status"=>"fail", "type"=>'duplicate', "code"=>200,"data" => $alreadyExistingQuestion));
	}elseif($optionLength ==1){
		return response(array("status"=>"fail", "type"=>'answerlength', "code"=>200,"data" => $alreadyExistingQuestion));
	}else{	
		
		foreach($CSVdata as $CSVRow){
			$input = array();			
			$input['policy'] =$CSVRow['0'];				
			$input['option_a'] =$CSVRow['1'];
			$input['option_b'] =$CSVRow['2'];
			$input['option_c'] =$CSVRow['3'];
			$input['option_d'] =$CSVRow['4'];
			$input['correct_option'] =$CSVRow['5'];					
			$policy = Policys::create($input);			
		}		
		return response(array("status"=>"success", "code"=>200,"data" => $policy));
	}
}





public function deletepolicy(Request $request) 
{	$data = $request->all(); 
	$id = $data['policyIdDelete'];
	$Policy = Policy::find($id);		
    $Policy->is_deleted 		=  1;
    $Policy->save();
    return response(array("status"=>"success", "code"=>200,"data" => $Policy));	  
}


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response  policypath
     */
    public function policydownload(Request $request,$policypath)
    {
        $file = '../public/policydouments/'.$policypath;
        $name = basename($file);
        return response()->download($file, $name);
      
    }
	

	
	
}