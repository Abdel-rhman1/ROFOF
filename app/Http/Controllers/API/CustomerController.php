<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\GroupConditions;
use App\Models\stor;
use Validator;
class CustomerController extends BaseController
{
    public function getStorCustomers($stor_id){
        $stor = stor::find($id);
        if(!$stor){
            return $this->sendError(' this stor dosent exist id' ,[] , 200);
        }
        $Customers = Customer::where('stor_id' , '=' , $stor_id)->get();
        return $this->sendResponse($Customers, 'Customers Reads succesfully');
    }
    public function storeCustomer(Request $request){
        //id' , 'stor_id' , 'group_id' , 'Fname' , 'Lname' , 'email' , 'country' ,
        //'phone' , 'brithday' , 'gender',
        $validator = Validator::make($request->all() ,
        [
            'stor_id'=>'required|numeric|min:0',
            'group_id'=>'required|numeric|min:0',
            'Fname'=>'required|min:4',
            'Lname'=>'required|min:4',
            'email'=>'required|min:4|unique:customers',
            'country_id'=>'required|numeric',
            'phone'=>'required',
            'brithday'=>'required|date',
            'gender'=>'required|numeric|min:1|max:3',
            'blocken'=>'numeric|min:0|max:1',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        $data = $request->except('token');
        $customer = Customer::create(
            $data
        );
        if(!$customer){
            return $this->sendError('Error In Creating This Element' ,[] , 500);
        }else{
            return $this->sendResponse($Customers, 'Customer are created succesfully');
        }
    }
    public function update(Request $request , $id){
        $customer = Customer::find($id);
        if(!$customer){
            return $this->sendError(' this Customer id dosent exist' ,[] , 400);
        }
        $validator = Validator::make($request->all() , [
            'stor_id'=>'numeric|min:0',
            'group_id'=>'numeric|min:0',
            'Fname'=>'min:4',
            'Lname'=>'min:4',
            'email'=>'min:4|unique:stors,name,'.$id,
            'country_id'=>'required|numeric',
            'city_id'=>'required|numeric',
            'brithday'=>'date',
            'gender'=>'numeric|min:1|max:3',
            'blocken'=>'numeric|min:0|max:1',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors()); 
        }
        $data = $request->except('token');
        $customer = Customer::where('id' , '=' , $id)->update($data);
        if($customer){
            return $this->sendResponse($Customers, 'Customer is updated succesfully');
        }else{
            return $this->sendError('Error In Updating This Element ' ,[] , 500);
        }
    }
    public function CustomerSeach(Request $request){
        // return Auth()->user();
        $validator = Validator($request->all() ,[
            'stor_id'=>'required|numeric|min:0',
            'word'=>'required',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        $stor = stor::find($request->stor_id);
        if(!$stor){
            return $this->sendError('dosent exist id' ,[] , 200);
        }
        $customers = Customer::where(
            'Fname' , 'like' , '%' . $request->word . '%'
        )->orwhere(
            'Lname' , 'like' , '%' . $request->word . '%'
        )->oewhere(
            'phone' ,  'like' , '%' . $request->word . '%'
        )->get();

        if($customers){
            return $this->sendResponse($customers, 'Customer is Reads succesfully');
        }else{
            return $this->sendError('Error In Reading Operation ' ,[] , 500);
        }
    }
    public function BlockCustomer($stor_id , $c_id){
        $customer = Customer::where('id',$c_id)->where('stor_id' , $stor_id);
        if(!$customer){
            return $this->sendError('
            Stor dosent exists or customer dosent belong to this stor' ,[] , 400);
        }
        $customer = Customer::where('id' ,'=',$c_id)->update([
            'blocken'=>1,
        ]);

        if($customer){
            return $this->sendResponse($customer, 'Customer is Blocken succesfully');
        }else{
            return $this->sendError('Error In Blocken Customer ' ,[] , 500);
        }
    }
    public function addCustomerToGroup($stor_id , $group_id , $cus_id){

    }
    
    public function createGroup(Request $request){
        $validator = Validator::make($request->all() , [
            'name'=>'required|min:3',
            'stor_id'=>'required|numeric|min:0',
            'paymentMethod'=>'required',
            'toJoin'=>'array|min:0',
            'toJoin.*conditionType'=>'string',
            'toJoin.*condition'=>'string',
            'toJoin.*value'=>'string',
            'transactionMethod'=>'required',
        ],[
            
        ]);

        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }else{
            
        }
    }

}
