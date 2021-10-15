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
        $stor = stor::find($stor_id);
        if(!$stor){
            return $this->sendError(' this stor dosent exist id' ,[] , 200);
        }
        $Customers = Customer::where('stor_id' , '=' , $stor_id)->get();
        return $this->sendResponse($Customers, 'Customers Reads succesfully');
    }
    public function storeCustomer(Request $request){
        $validator = Validator::make($request->all(),[
            'stor_id'=>'required|numeric|min:0',
            'group_id'=>'numeric|min:0',
            'Fname'=>'required|min:4',
            'Lname'=>'required|min:4',
            'email'=>'email|unique:customers',
            'country_id'=>'required|numeric|min:0',
            'phone'=>'required',
            'brithday'=>'date',
            'gender'=>'numeric|min:1|max:3',
            'blocken'=>'numeric|min:0|max:1',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        $stor  = stor::find($request->stor_id);
        if(!$stor){
            return $this->sendError('This Stor dosent exist', []);
        }
        $data = $request->except('token');
        $customer = Customer::create(
            $data
        );
        
        if(!$customer){
            return $this->sendError('Error In Creating This Element' ,[] , 500);
        }else{
            return $this->sendResponse($customer, 'Customer are created succesfully');
        }
    }
    public function updateCust(Request $request , $id){
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
            'country_id'=>'numeric',
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
            $customer = Customer::find($id);
            return $this->sendResponse($customer, 'Customer is updated succesfully');
        }else{
            return $this->sendError('Error In Updating This Element ' ,[] , 500);
        }
    }
    public function CustomerSeach(Request $request){
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
        )->orwhere(
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
            $customer = Customer::find($c_id);
            return $this->sendResponse($customer, 'Customer is Blocken succesfully');
        }else{
            return $this->sendError('Error In Blocken Customer ' ,[] , 500);
        }
    }
    public function addCustomerToGroup(int $group_id , int $customer_id , int $stor_id){
        $customer = Customer::find($customer_id);
        $stor = stor::find($stor_id);
        $customergroup = CustomerGroup::find($group_id);
        if(!$customergroup || !$customer || !$stor){
            return $this->sendError('Stor Or Group or Customer Dosent Exists' ,[] , 500);
        }
        $cus = Customer::where('id' , '=' , $customer_id)->update([
            'group_id'=>$group_id,
        ]);
        if($cus){
            return $this->sendResponse($customer, 'This Customer added To This Group succesfully');
        }else{
            return $this->sendError('Error In Adding This Customer This Group ' ,[] , 500);
        }
    }
    public function removeCustomerFromGroup(int $group_id , int $customer_id , int $stor_id){
        $customer = Customer::find($customer_id);
        $stor = stor::find($stor_id);
        $customergroup = CustomerGroup::find($group_id);
        if(!$customergroup || !$customer || !$stor){
            return $this->sendError('Stor Or Group or Customer Dosent Exists' ,[] , 500);
        }
        $cus = Customer::where('id' , '=' , $customer_id)->where('group_id' , '=' , $group_id)->update([
            'group_id'=>0,
        ]);
        if($cus){
            return $this->sendResponse($customer, 'This Customer removed To This Group succesfully');
        }else{
            return $this->sendError('Error In Removing This Customer from This This Group ' ,[] , 500);
        }
    }
    public function search(){

    }
}
