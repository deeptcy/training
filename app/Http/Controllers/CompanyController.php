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

class CompanyController extends Controller
{
    
var $recordPerPage =20;

	function index(){
		
		return view('companylist');
		
	}
	
	public function companydetail(Request $request, $id)
    {
		 $CompanyData = User::where('is_deleted', '=', '0')->where('id', '=', $id)->get()->toArray();
		 $Company =  $CompanyData[0];
	
        return view('companydetail', compact('Company'));
       
    }
	
function ajaxcompanylist(Request $request){
	
		$data = $request->all();
		$page =$data['pagination']['page'];	
		$per_page = $data['pagination']['perpage'];	
		if($per_page ==''){
		$per_page =10; }		
		$method='GET';
		$searchArray['per_page']=$per_page;
		$searchArray['page']	=$page;
		
	//$pageNo = 1;
		$companyData = User::select('*');			
		if(@isset($data['query']['companygeneralSearch'])){
			$searchKey =$data['query']['companygeneralSearch'];	
			$companyData = $companyData->where(function($q) use ($searchKey){
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
		$companyData->where('is_deleted', '=', '0');
		$companyData->where('user_type', '=', 'company');
		$companyData->offset($offset);
        $companyData->limit($per_page);
		$companyData->orderBy($sortfield, $sortorder);
		$companyData =	$companyData->get()->toArray();
		
		
		$companyCount = User::select('*');
		if(@isset($data['query']['generalSearch'])){
			$searchKey =$data['query']['generalSearch'];	
			$companyCount = $companyCount->where(function($q) use ($searchKey){
				$q->where('name', 'LIKE', '%' . $searchKey . '%')
				->orWhere('email', 'LIKE', '%' . $searchKey . '%');
		});
		}
		$companyCount->where('is_deleted', '=', '0');
		$companyCount->where('user_type', '=', 'company');
		$companyCount =$companyCount->get();			
		$totalRecord =$companyCount->count();	
		
		$resultDataTable['data'] = $companyData;	
		$resultDataTable['meta']['page'] = $page;
		$resultDataTable['meta']['pages'] = ceil($totalRecord/$per_page);
		$resultDataTable['meta']['perpage'] = $per_page;
		$resultDataTable['meta']['total'] = $totalRecord;
			return json_encode($resultDataTable);
}
		
    /**
     * Create a new company instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Company
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_type' => 'company',
            'password' => Hash::make($data['password']),
        ]);
    } 
	/**
     * Create a new company instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Company
     */
    public function createcompany(Request $request)
    {	

	


	$data = $request->all();
			$validator = Validator::make($request->all(), [ 
				'companyName' => 'required|min:5', 
				'companyEmail' => 'required|email|unique:users,email,0,id,is_deleted,0',
			]);		
		if ($validator->fails()) { 
				//return response()->json(['error'=>$validator->errors()], 400);    
				return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
			}else{
				$input['password'] = bcrypt('pass123'); 
				$input['name'] =$data['companyName'];
				$input['email'] =$data['companyEmail'];
				$input['user_type'] = 'company';
				$company = User::create($input);
	
				return response(array("status"=>"success", "code"=>400,"data" => $data));
			}	
       
    }
	
	/**
     * Create a new company instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Company
     */
    public function editcompany(Request $request)
    {		$data = $request->all();
			$companyId = $data['companyId'];
			$validator = Validator::make($request->all(), [ 
				'companyId' => 'required', 
				'companyNameEdit' => 'required|min:5', 
				'companyEmailEdit' => 'required|email|unique:users,email,'.$companyId.',id,is_deleted,0',
			]);	
	
		if ($validator->fails()) { 
				//return response()->json(['error'=>$validator->errors()], 400);    
				return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
			}else{
				
					//	echo '<pre>'; print_r($data); die;	
				//$input['password'] = bcrypt('pass123'); 
				$input['name'] =$data['companyNameEdit'];
				$input['email'] =$data['companyEmailEdit'];
				if(isset($data['companypassword']) && $data['companypassword']!==''){
					$input['password'] = bcrypt($data['companypassword']); 
				}
				
				User::whereId($companyId)->update($input);
				//$company = Company::create($input);
		
				return response(array("status"=>"success", "code"=>400,"data" => $data));
			}	
       
    }	
	/**
     * Create a new company instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Company
     */
    public function deletecompany(Request $request)
    {		$data = $request->all();
			$companyId = $data['companyIdDelete'];
			$validator = Validator::make($request->all(), [ 
				'companyIdDelete' => 'required'
			]);	
	
		if ($validator->fails()) { 
				//return response()->json(['error'=>$validator->errors()], 400);    
				return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
			}else{
				
					//	echo '<pre>'; print_r($data); die;	
				//$input['password'] = bcrypt('pass123'); 
				$input['is_deleted'] =1;
				
				
				User::whereId($companyId)->update($input);
				//$company = Company::create($input);
		
				return response(array("status"=>"success", "code"=>400,"data" => $data));
			}	
       
    }

	
	
	protected function registercompany(Request $request)
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
    public function logincompanyfrm(Request $request)
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