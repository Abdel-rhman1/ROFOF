<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerGroup;
use App\Models\stor;
use App\Models\CusGroupConditions;
use Validator;
use Illuminate\Validation\Rule;
class CustomerGroupController extends BaseController
{
    public function getGroups(int $stor_id){
        $stor = stor::find($stor_id);
        if(!$stor){
            return $this->sendError(' this stor dosent exist' ,[] , 200);
        }
        $customerGroups = CustomerGroup::where('customer_groups.stor_id' , '=' , $stor_id)->get();
        if($customerGroups){
            return $this->sendResponse($customerGroups, 'Customer Groups Reads succesfully');
        }else{
            return $this->sendError('Error In Reads Stor Customer Groups' , []);
        } 
    }
    public function create(Request $request){
        $validator = Validator::make( $request->all() , [
            'stor_id'=>'required|numeric|min:0',
            'name'=>['required' , 'min:3 ' , 'max:20' ,Rule::unique('customer_groups')->where(function($query) use ($request){
                $query->where('stor_id', '=', $request->stor_id);
            })],
            'paymentMethod'=>'required',
            'transactionMethod'=>'required',
            'condition'=>'array',
            'condition.conditionToJoinType'=>'min:0',
            'condition.conditionToJoin'=>'min:0',
            'condition.conditionValue'=>'min:0',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        $stor = stor::find($request->stor_id);
        if(!$stor){
            return $this->sendError('This Stor Dosent Exist', []);
        }
        $data = $request->except('token');
        $customergroups = CustomerGroup::create($data);
        
        // for($i=0;$i<count($request->condition->toArray());$i++){
        //    $customerGroupCondition = CusGroupConditions::create([
        //         'stor_id'=>$request->stor_id,
        //         'group_id'=>$request->$customergroup->id,
        //         'conditionToJoinType'=>$request->condition[$i]->conditionToJoinType,
        //         'conditionToJoin'=>$request->condition[$i]->conditionToJoin,
        //         'conditionValue'=>$request->condition[$i]->conditionValue,
        //     ]);
        // }
        if($customergroups){
            return $this->sendResponse($customergroups, 'Customer Group are created succesfully');
        }else{
            return $this->sendError('Error In Creating This Customer Group', []);
        }
    }
    public function updateGroup(Request $request , $Group_id){
        $customergroup = CustomerGroup::find($Group_id);
        if(!$customergroup){
            return $this->sendError('This Group Dosent Exist', []);
        }
        $validator = Validator::make( $request->all() , [
            'stor_id'=>'numeric|min:0',
            'name'=>[ 'min:3 ' , 'max:20' ,Rule::unique('customer_groups')->where(function($query) use ($request){
                $query->where('stor_id', '=', $request->stor_id);
            })],
            'paymentMethod'=>'min:3',
            'transactionMethod'=>'min:3',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        $stor = stor::find($request->stor_id);
        if(!$stor){
            return $this->sendError('This Stor Dosent Exist', []);
        }
        $data = $request->except('token');
        $customergroups = CustomerGroup::where('id' , '=' , $Group_id)->update($data);
        if($customergroups){
            $customergroups = CustomerGroup::find($Group_id);
            return $this->sendResponse($customergroups, 'Customer Group are Updated succesfully');
        }else{
            return $this->sendError('Error In Updating This Customer Group', []);
        }
    }
    public function deleteGroup($G_id){
        $customergroup = CustomerGroup::find($G_id);
        if(!$customergroup){
            return $this->sendError('This Group Dosent Exist',[]);
        }else{
           $group = CustomerGroup::where('id' , '=' , $G_id)->delete();
            if(!$group){
                return $this->sendError('Error In Deleting This Customer Group', []);
            }else{
                return $this->sendResponse([], 'This Customer Group are Deleted succesfully');
            }
        }
    }   
}