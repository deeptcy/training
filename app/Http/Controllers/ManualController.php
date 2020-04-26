<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Pages; 
use App\Models\Manual; 
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
       
	    $Manual = Manual::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get()->toArray();	
        return view('manuallist', ['Manual' => $Manual] );
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
		$questiosData = Manual::select('id','manual_text','manual_title');			
		if(@isset($data['query']['manualgeneralSearch'])){
			$searchKey =$data['query']['manualgeneralSearch'];	
			$questiosData = $questiosData->where(function($q) use ($searchKey){
				$q->where('manual_title', 'LIKE', '%' . $searchKey . '%')
				->orWhere('manual_text', 'LIKE', '%' . $searchKey . '%');
		});
		}	
		$sortfield ='id';
		if(@isset($data['sort']['field']) ){
			if(in_array($data['sort']['field'], array('manual_text','id'))){
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

		$userCount = Manual::select('*');
		if(@isset($data['query']['manualgeneralSearch'])){
			$searchKey =$data['query']['manualgeneralSearch'];	
			$userCount = $userCount->where(function($q) use ($searchKey){
				$q->where('manual_title', 'LIKE', '%' . $searchKey . '%');
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
				'manual_title'=> 'required|min:5', 
			]);	
			
			
			
			
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			
			
		
			$input['manual_title'] =$data['manual_title'];
			$input['manual_text'] =$data['manual_text'];				
			$manual = Manual::create($input);		
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
		if($files=$request->file('file')){
			$validator = Validator::make($request->all(), [ 
					'manualId' => 'required', 
					'title' => 'required|min:2', 
					"file" => "nullable|mimes:pdf|max:10000",				
				]);		
		}else{
				$validator = Validator::make($request->all(), [ 
				'manualId' => 'required', 
				'title' => 'required|min:2', 			
			]);	
		}			
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			
			
			$id = $data['manualId'];

            $Manual = Manual::find($id);	
			
			
			if($files=$request->file('file')){
				$name=$files->getClientOriginalName();			
				$name = time().'.'.$files->getClientOriginalExtension(); 
				$destinationPath = public_path('/manualdouments/');
				$files->move($destinationPath, $name);
				$Manual->filepath 		=   $name;
			}	
		
			
				
        $Manual->title 		=  $request->get('title');
        $Manual->qmsdesc 		=  $request->get('qmsdesc');	       
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
	$Manual = Manual::find($id);		
    $Manual->is_deleted 		=  1;
    $Manual->save();
    return response(array("status"=>"success", "code"=>200,"data" => $Manual));	  
}


   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response  manualpath
     */
    public function manualdownload(Request $request,$manualpath)
    {
        $file = '../public/manualdouments/'.$manualpath;
        $name = basename($file);
        return response()->download($file, $name);
      
    }
	

	
	
}