<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Pages; 
use App\Models\Questions; 
use App\Imports\UsersImport;
use App\Models\Courses; 




class QuestionController extends Controller
{
	
	var $recordPerPage =20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function questionlist()
    {
       // $pages = Pages::all();	
        $Questions = Questions::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get();
	 $Courses = Courses::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get();
	
	
        return view('questionlist', compact('Questions', 'Courses'));
    }
	
	public function questiondetail(Request $request, $id)
    {
       $QuestionData = questions::where('is_deleted', '=', '0')->where('id', '=', $id)->get()->toArray();
		$Question =  $QuestionData[0];
        return view('questiondetail', compact('Question'));
    }
	
	function ajaxquestionlist(Request $request){
		$data = $request->all();
		$page =$data['pagination']['page'];	
		$per_page = $data['pagination']['perpage'];	
		if($per_page ==''){
		$per_page =10; }		
		$method='GET';
		$searchArray['per_page']=$per_page;
		$searchArray['page']	=$page;
		
	//$pageNo = 1;
	
	
	
		$questiosData = Questions::select('questions.id as id','question','option_a','option_b','option_c','option_d','correct_option','name','course_id');			
		if(@isset($data['query']['questiongeneralSearch'])){
			$searchKey =$data['query']['questiongeneralSearch'];	
			$questiosData = $questiosData->where(function($q) use ($searchKey){
				$q->where('question', 'LIKE', '%' . $searchKey . '%')
				->orWhere('correct_option', 'LIKE', '%' . $searchKey . '%')
				->orWhere('name', 'LIKE', '%' . $searchKey . '%')
				->orWhere('course_id', 'LIKE', '%' . $searchKey . '%');
		});
		}	
		$sortfield ='id';
		if(@isset($data['sort']['field']) ){
			if(in_array($data['sort']['field'], array('question','id','correct_option','name'))){
			$sortfield =$data['sort']['field'];
			}else{ $sortfield  = 'questions.id'; }
		}
		$sortorder ='ASC';
		if(@isset($data['sort']['sort'])){
			$sortorder =$data['sort']['sort'];
		}
		
		$questiosData->leftJoin('courses', function ($join) {
            $join->on('courses.id', '=', 'questions.course_id');
			});
		
		
		
		if($page ==1){ $offset = 0; }else{ $offset = $this->recordPerPage*($page-1); }
		$questiosData->where('questions.is_deleted', '=', '0');
		$questiosData->offset($offset);
        $questiosData->limit($this->recordPerPage);
		$questiosData->orderBy($sortfield, $sortorder);
		$questiosData =	$questiosData->get()->toArray();		
	

		$userCount = Questions::select('*');
		if(@isset($data['query']['questiongeneralSearch'])){
			$searchKey =$data['query']['questiongeneralSearch'];	
			$userCount = $userCount->where(function($q) use ($searchKey){
				$q->where('question', 'LIKE', '%' . $searchKey . '%');
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
    public function questionadd(Request $request)
    {		$data = $request->all();
			$validator = Validator::make($request->all(), [ 
				'question' => 'required|min:5', 
				'correct_option' => "required|string|min:1|max:1|in:". implode(',', array('A','B','C','D')),
			]);					
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			$input['question'] =$data['question'];				
			$input['option_a'] =$data['option_a'];
			$input['option_b'] =$data['option_b'];
			$input['option_c'] =$data['option_c'];
			$input['option_d'] =$data['option_d'];
			$input['course_id'] =$data['course_id'];
			$input['correct_option'] =$data['correct_option'];					
			$question = Questions::create($input);		
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
    public function editquestion(Request $request)
    {     
		$data = $request->all();
		$validator = Validator::make($request->all(), [ 
				'questionId' => 'required', 
				'question' => 'required|min:5', 
				'correct_option' => "required|string|min:1|max:1|in:". implode(',', array('A','B','C','D')),
			]);					
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			$id = $data['questionId'];

        $Question = Questions::find($id);		
        $Question->question 		=  $request->get('question');
        $Question->option_a 		=  $request->get('option_a');		
        $Question->option_b 		=  $request->get('option_b');
        $Question->option_c 		=  $request->get('option_c');
        $Question->option_d		 	=  $request->get('option_d');
        $Question->course_id		 	=  $request->get('course_id');
        $Question->correct_option	=  $request->get('correct_option');
        $Question->save();
      return response(array("status"=>"success", "code"=>200,"data" => $Question));
    }}








public function parseImport(Request $request)
{	$data = $request->all();
    $file     = request()->file('file');	 
	$path = $file->getPathname();	
	$CSVdata = array_map('str_getcsv', file($path));
	$alreadyExistingQuestion = array();
	$duplicateQuestions =0;
	$optionLength =0;
	$header_added = $data['header_added'];
	if($header_added =='true'){
		array_shift($CSVdata);
	}
	$courseId = $data ['course_id'];
	
	foreach($CSVdata as $CSVRow){	
			$question = $CSVRow['0'];
			$correctOption =$CSVRow['5'];		
			if(strlen($correctOption)>1){
				$optionLength =1;
			}
		$QuestionRecord = Questions::where('is_deleted', '=', '0')->where('question', '=', $question)->get()->toArray();
		if(count($QuestionRecord)>=1){
			$alreadyExistingQuestion[]= $question;
			$duplicateQuestions =1;	
		}
	}
	if($duplicateQuestions ==1){
		return response(array("status"=>"fail", "type"=>'duplicate', "code"=>200,"data" => $alreadyExistingQuestion));
	}elseif($optionLength ==1){
		return response(array("status"=>"fail", "type"=>'answerlength', "code"=>200,"data" => $alreadyExistingQuestion));
	}else{	
		
		foreach($CSVdata as $CSVRow){
			$input = array();			
			$input['question'] =$CSVRow['0'];				
			$input['option_a'] =$CSVRow['1'];
			$input['option_b'] =$CSVRow['2'];
			$input['option_c'] =$CSVRow['3'];
			$input['option_d'] =$CSVRow['4'];
			$input['correct_option'] =$CSVRow['5'];	
			
			$input['course_id'] =$courseId;					
			$question = Questions::create($input);			
		}		
		return response(array("status"=>"success", "code"=>200,"data" => $question));
	}
}





public function deletequestion(Request $request)
{	$data = $request->all(); 
	$id = $data['questionIdDelete'];
	$Question = Questions::find($id);		
    $Question->is_deleted 		=  1;
    $Question->save();
    return response(array("status"=>"success", "code"=>200,"data" => $Question));	  
}




	
	
}