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

class MyUserController extends Controller
{
    
var $recordPerPage =20;
function callAPI($method, $url, $data=''){
	$curl = curl_init();
	switch ($method){
		case "POST":
			curl_setopt($curl, CURLOPT_POST, 1);
			if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			break;
		case "PUT":
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
			if ($data)
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
			break;
		case "GET":
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
			break;
		default:
			if ($data)
				$url = sprintf("%s?%s", $url, http_build_query($data));
	}
	curl_setopt($curl, CURLOPT_URL, $url);
	  curl_setopt($curl, CURLOPT_HEADER, 1);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array(
		'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImE3YmY4NjVlNzc2NjYwNjIzMzM3MzAzMDdiNjU0ZWE5Nzg3ZmIyZjYzNTA0YjY1NWQ0NDhiYTZhZDE1N2IzNjgzNjI3MTMxNDVjYmRjODE5In0.eyJhdWQiOiIxIiwianRpIjoiYTdiZjg2NWU3NzY2NjA2MjMzMzczMDMwN2I2NTRlYTk3ODdmYjJmNjM1MDRiNjU1ZDQ0OGJhNmFkMTU3YjM2ODM2MjcxMzE0NWNiZGM4MTkiLCJpYXQiOjE1NjAwNTcyNjYsIm5iZiI6MTU2MDA1NzI2NiwiZXhwIjoxNTkxNjc5NjY1LCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.kTTALnBq_UKDCshFxgiHBtJSRy-x8A7mdJLqePctN_wbt1gXgKOu4Bmezc5VJjb2TgnFPeCzeAFnYJbdPnOi6NQcu7cwEHugI1KH0f_L2va3HaFYjwLcctc6h_YgdlFUgnszv8OLLjDYY5RPud-a-3eWTezGAQ_PScslHez55aWY6uhOkfTwQ4-KLUzjLzZ0Jk3YqJiFROZyNUh9RbTUSSJaOPVAsovPKDALiVgVyLx5bcsKXHUUjzM2O3hGmrRl7x5uNQ9_QC_-7tTVDf-vBm3GnaTYqAhKXx6GNGyaYYbu2pYVhyt8d6WLEDVBgYsH_auR7c-RULF_VHSUMrui0A5mZz_ioxkpzwQvDf2OvAk2XZJrjf4ToXfo7wgW-Wi6MdAXo-qGDMKv8UGh_DW9MYv-hNV3zH8ZX31NNnDnU4v61a986Oy_ZqqBB1UY2USiDA2kBwWiucaBMQ6Ij6-6yiFWkqJDFeW42ql5hVoYpyGLh3mJ9BYKbf9VmhCTQCoGu4EFx_DAeP45nsOVcfwTZvGS4b8-IlVf5al4Hj22qeac2qLn98Kszy2vdblpSZmy2g5QvXXg73WmugVlCX3Myscw3sA_L-Mku7-GAgOCNAZ33fWJIUZ9W6hPG1qhYGriqguSxdRzDiH4uFtRBRTPO9ZHazIY5ES6RY-cwnyBxd4',
		'Content-Type: application/json',
		'Accept: application/json',
	));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);;
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // EXECUTE:
	$result = curl_exec($curl);
	if(!$result){die("Connection Failure");}
	
	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$header = substr($result, 0, $header_size);
	$body = substr($result, $header_size);
	$header = explode("\r\n", $header); // The seperator used in the Response Header is CRLF (Aka. \r\n) 
	$header = array_filter($header);
	foreach ($header as $headerObj) {
		if (! preg_match('/^([^:]+):(.*)$/', $headerObj, $output)) continue;
		$parsedArray[$output[1]] = $output[2];
	} 
	
	curl_close($curl); 	
	return array('headerData'=>$parsedArray, 'responceBody'=>$body);
}
	function index(){
		
		return view('myuserslist');
		
	}
	
	public function mycandidatedetail(Request $request, $id)
    {
      $MyCandidateData = User::where('is_deleted', '=', '0')->where('id', '=', $id)->get()->toArray();
		$MyCandidate =  $MyCandidateData[0];
        return view('mycandidatedetail', compact('MyCandidate'));
    }
	
function ajaxmyuserslist(Request $request){
		$data = $request->all();
		$page =$data['pagination']['page'];	
		$per_page = $data['pagination']['perpage'];	
		if($per_page ==''){
		$per_page =10; }		
		$method='GET';
		$searchArray['per_page']=$per_page;
		$searchArray['page']	=$page;
		
	//$pageNo = 1;
		$usersData = User::select('*');			
		if(@isset($data['query']['generalSearch'])){
			$searchKey =$data['query']['generalSearch'];	
			$usersData = $usersData->where(function($q) use ($searchKey){
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
		if($page ==1){ $offset = 0; }else{ $offset = $this->recordPerPage*($page-1); }
		$usersData->where('is_deleted', '=', '0');
		$usersData->offset($offset);
        $usersData->limit($this->recordPerPage);
		$usersData->orderBy($sortfield, $sortorder);
		$usersData =	$usersData->get()->toArray();
		
		
		$userCount = User::select('*');
		if(@isset($data['query']['generalSearch'])){
			$searchKey =$data['query']['generalSearch'];	
			$userCount = $userCount->where(function($q) use ($searchKey){
				$q->where('name', 'LIKE', '%' . $searchKey . '%')
				->orWhere('email', 'LIKE', '%' . $searchKey . '%');
		});
		}
		$userCount->where('is_deleted', '=', '0');
		$userCount =$userCount->get();			
		$totalRecord =$userCount->count();	
		
		$resultDataTable['data'] = $usersData;	
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
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    } 
	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function createmyuser(Request $request)
    {		$data = $request->all();
			$validator = Validator::make($request->all(), [ 
				'userName' => 'required|min:5', 
				'userEmail' => 'required|email|unique:users,email,0,id,is_deleted,0',
			]);		
		if ($validator->fails()) { 
				//return response()->json(['error'=>$validator->errors()], 400);    
				return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
			}else{
				$input['password'] = bcrypt('pass123'); 
				$input['name'] =$data['userName'];
				$input['email'] =$data['userEmail'];
				$user = User::create($input);
		
				return response(array("status"=>"success", "code"=>400,"data" => $data));
			}	
       
    }
	
	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function editmyuser(Request $request)
    {		$data = $request->all();
			$userId = $data['userId'];
			$validator = Validator::make($request->all(), [ 
				'userId' => 'required', 
				'userNameEdit' => 'required|min:5', 
				'userEmailEdit' => 'required|email|unique:users,email,'.$userId.',id,is_deleted,0',
			]);	
	
		if ($validator->fails()) { 
				//return response()->json(['error'=>$validator->errors()], 400);    
				return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
			}else{
				
					//	echo '<pre>'; print_r($data); die;	
				//$input['password'] = bcrypt('pass123'); 
				$input['name'] =$data['userNameEdit'];
				$input['email'] =$data['userEmailEdit'];
				if(isset($data['userpassword']) && $data['userpassword']!==''){
					$input['password'] = bcrypt($data['userpassword']); 
				}
				
				User::whereId($userId)->update($input);
				//$user = User::create($input);
		
				return response(array("status"=>"success", "code"=>400,"data" => $data));
			}	
       
    }	
	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    public function deletemyuser(Request $request)
    {		$data = $request->all();
			$userId = $data['userIdDelete'];
			$validator = Validator::make($request->all(), [ 
				'userIdDelete' => 'required'
			]);	
	
		if ($validator->fails()) { 
				//return response()->json(['error'=>$validator->errors()], 400);    
				return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
			}else{
				
					//	echo '<pre>'; print_r($data); die;	
				//$input['password'] = bcrypt('pass123'); 
				$input['is_deleted'] =1;
				
				
				User::whereId($userId)->update($input);
				//$user = User::create($input);
		
				return response(array("status"=>"success", "code"=>400,"data" => $data));
			}	
       
    }
	
	
	
	/**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function registeruser(Request $request)
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
    public function loginuserfrm(Request $request)
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