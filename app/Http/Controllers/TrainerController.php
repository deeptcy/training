<?php
namespace App\Http\Controllers;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Verified;

class TrainerController extends Controller
{
    
var $recordPerPage =20;

	function index(){
		
		return view('trainerlist');
		
	}
	
	public function trainerdetail(Request $request, $id)
    {
		$TrainerData = User::where('is_deleted', '=', '0')->where('id', '=', $id)->get()->toArray();
		$Trainer =  $TrainerData[0];
        return view('trainerdetail', compact('Trainer'));
    }
	
function ajaxtrainerlist(Request $request){
	
		$data = $request->all();
		$page =$data['pagination']['page'];	
		$per_page = $data['pagination']['perpage'];	
		if($per_page ==''){
		$per_page =10; }		
		$method='GET';
		$searchArray['per_page']=$per_page;
		$searchArray['page']	=$page;
		
	//$pageNo = 1;
		$trainerData = User::select('*');			
		if(@isset($data['query']['trainergeneralSearch'])){
			$searchKey =$data['query']['trainergeneralSearch'];	
			$trainerData = $trainerData->where(function($q) use ($searchKey){
				$q->where('name', 'LIKE', '%' . $searchKey . '%')
				->orWhere('email', 'LIKE', '%' . $searchKey . '%');
		});
		}	
		$sortfield ='id';
		if(@isset($data['sort']['field']) ){
			if(in_array($data['sort']['field'], array('name','email','id'))){
			$sortfield =$data['sort']['field'];
			}else{$sortfield  = 'id'; }
		}
		$sortorder ='ASC';
		if(@isset($data['sort']['sort'])){
			$sortorder =$data['sort']['sort'];
		}
		if($page ==1){ $offset = 0; }else{ $offset = $per_page*($page-1); }
		$trainerData->where('is_deleted', '=', '0');
		$trainerData->where('user_type', '=', 'trainer');
		$trainerData->offset($offset);
        $trainerData->limit($per_page);
		$trainerData->orderBy($sortfield, $sortorder);
		$trainerData =	$trainerData->get()->toArray();
		
		
		$trainerCount = User::select('*');
		if(@isset($data['query']['trainergeneralSearch'])){
			$searchKey =$data['query']['trainergeneralSearch'];	
			$trainerCount = $trainerCount->where(function($q) use ($searchKey){
				$q->where('name', 'LIKE', '%' . $searchKey . '%')
				->orWhere('email', 'LIKE', '%' . $searchKey . '%');
		});
		}
		$trainerCount->where('is_deleted', '=', '0');
				$trainerCount->where('user_type', '=', 'trainer');
		$trainerCount =$trainerCount->get();			
		$totalRecord =$trainerCount->count();	
		
		$resultDataTable['data'] = $trainerData;	
		$resultDataTable['meta']['page'] = $page;
		$resultDataTable['meta']['pages'] = ceil($totalRecord/$per_page);
		$resultDataTable['meta']['perpage'] = $per_page;
		$resultDataTable['meta']['total'] = $totalRecord;
			return json_encode($resultDataTable);
}
		
    /**
     * Create a new trainer instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Trainer
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			 'user_type' => 'trainer',
            'password' => Hash::make($data['password']),
        ]);
    } 
	/**
     * Create a new trainer instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Trainer
     */
    public function createtrainer(Request $request)
    {	

		$data = $request->all();
			$validator = Validator::make($request->all(), [ 
				'trainerName' => 'required|min:5', 
				'trainerEmail' => 'required|email|unique:users,email,0,id,is_deleted,0',
			]);		
		if ($validator->fails()) { 
				//return response()->json(['error'=>$validator->errors()], 400);    
				return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
			}else{
				$input['password'] = bcrypt('pass123'); 
				$input['name'] =$data['trainerName'];
				$input['email'] =$data['trainerEmail'];
				
				$input['user_type'] ='trainer';
				$trainer = User::create($input);
	
				return response(array("status"=>"success", "code"=>400,"data" => $data));
			}	
       
    }
	
	/**
     * Create a new trainer instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Trainer
     */
    public function edittrainer(Request $request)
    {		
	$data = $request->all();
			$trainerId = $data['trainerId'];
			$validator = Validator::make($request->all(), [ 
				'trainerId' => 'required', 
				'trainerNameEdit' => 'required|min:5', 
				'trainerEmailEdit' => 'required|email|unique:users,email,'.$trainerId.',id,is_deleted,0',
			]);	
	
		if ($validator->fails()) { 
				//return response()->json(['error'=>$validator->errors()], 400);    
				return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
			}else{
				
					//	echo '<pre>'; print_r($data); die;	
				//$input['password'] = bcrypt('pass123'); 
				$input['name'] =$data['trainerNameEdit'];
				$input['email'] =$data['trainerEmailEdit'];
				if(isset($data['trainerpassword']) && $data['trainerpassword']!==''){
					$input['password'] = bcrypt($data['trainerpassword']); 
				}
				
				User::whereId($trainerId)->update($input);
				//$trainer = Trainer::create($input);
		
				return response(array("status"=>"success", "code"=>200,"data" => $data));
			}	
       
    }	
	/**
     * Create a new trainer instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Trainer
     */
    public function deletetrainer(Request $request)
    {		$data = $request->all();
			$trainerId = $data['trainerIdDelete'];
			$validator = Validator::make($request->all(), [ 
				'trainerIdDelete' => 'required'
			]);	
	
		if ($validator->fails()) { 
				//return response()->json(['error'=>$validator->errors()], 400);    
				return response(array("status"=>"fail", "code"=>200,'message' => $validator->errors(),"data" => $data));
			}else{
				
					//	echo '<pre>'; print_r($data); die;	
				//$input['password'] = bcrypt('pass123'); 
				$input['is_deleted'] =1;
				
				
				User::whereId($trainerId)->update($input);
				//$trainer = Trainer::create($input);
		
				return response(array("status"=>"success", "code"=>200,"data" => $data));
			}	
       
    }

	
	
	protected function registertrainer(Request $request)
    { 
	
	$data =$request->all();	
	
	 $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);			
		if ($validator->fails()){ 
			return response(array("httpStatus"=>200,  "status"=>"fail", "message"=>"Validation error12", 'errors' => $validator->errors()),200);
		}else{
			
			User::create([
            'name' => $data['name'],
            'email' => $data['email'],
			'user_type' => $data['candidatetype'],
            'password' => Hash::make($data['password']),
        ]);
			return response(array("httpStatus"=>200,  "status"=>"success", "message"=>"Register successfully.."),200);	
		}	     
    }
		
	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function logintrainerfrm(Request $request)
    { 
	
	$data =$request->all();	
	
	 $validator = Validator::make($data, [
            
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);			
		if ($validator->fails()){ 
			return response(array("httpStatus"=>200,  "status"=>"fail", "message"=>"Validation error12", 'errors' => $validator->errors()),200);
		}else{
			
			$email = $data['email'];
			$password = $data['password'];
			 if (Auth::attempt(['email' => trim($email),
                    'password' => $password,
                        ], $request->has('remember'))) {

			$message ='Login sucessfully redirecting to dashboard';
           return response(array("httpStatus"=>200,  "status"=>"success", "message"=>$message),200);

			
			
        } else {
            $message = 'These credentials do not match our records.';

           return response(array("httpStatus"=>200,  "status"=>"credentials", "message"=>$message),200);
			
			
			
		}
			
			
			
			
			return response(array("httpStatus"=>200,  "status"=>"fail", "message"=>"Validation error12"),200);
			     
    }
	
	
	
	}
	
	}