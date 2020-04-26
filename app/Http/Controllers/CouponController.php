<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Config;
use App\Models\Pages; 
use App\Models\Coupons; 
use App\Imports\UsersImport;





class CouponController extends Controller
{
	
	var $recordPerPage =20;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function couponlist()
    {
       // $pages = Pages::all();	
        $Coupons = Coupons::where('is_deleted', '=', '0')->orderBy('id', 'ASC' )->get();

        return view('couponlist', compact('Coupons'));
    }
	
	function ajaxcouponlist(Request $request){
		$data = $request->all();
		$page =$data['pagination']['page'];	
		$per_page = $data['pagination']['perpage'];	
		if($per_page ==''){
		$per_page =10; }		
		$method='GET';
		$searchArray['per_page']=$per_page;
		$searchArray['page']	=$page;
		
	//$pageNo = 1;
		$questiosData = Coupons::select('*');			
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
		
		$userCount = Coupons::select('*');
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
    public function couponadd(Request $request)
    {		$data = $request->all();
			$validator = Validator::make($request->all(), [ 
				'code'=> 'required|min:5', 				
			]);			
		if ($validator->fails()) { 
			return response(array("status"=>"fail", "code"=>400,'message' => $validator->errors(),"data" => $data));
		}else{
			$input['code'] 			=$data['code'];	
			$input['discount_type'] =$data['coupontype'];	
			$input['discount'] 		=$data['amount'];	
			$input['description'] 	=$data['description'];
						
			$course = Coupons::create($input);		
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

        $Course = Coupons::find($id);		
        $Course->name 		=  $request->get('name');
        $Course->description 		=  $request->get('description');		
        
        $Course->save();
      return response(array("status"=>"success", "code"=>200,"data" => $Course));
    }}













public function deletecoupon(Request $request)
{	$data = $request->all(); 
	$id = $data['couponIdDelete'];
	$Coupon = Coupons::find($id);		
    $Coupon->is_deleted 		=  1;
    $Coupon->save();
    return response(array("status"=>"success", "code"=>200,"data" => $Coupon));	  
}




	
	
}