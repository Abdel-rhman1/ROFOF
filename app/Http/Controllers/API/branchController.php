<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\branch;
use Auth;
use Validator;
class branchController extends BaseController
{
    public function index(){

    }   
    public function createbranch(Request $resquest){
        //'id' ,'vendor_id','stor_id','mainBranch','Name','country','city','address'
        //,'postal_code','street','state','phone','mobile','whattsap','period','uponrecipt',
        //'uponreciptcost','sun','mon','tues','wend','thur','fri','sta'
        $validator = Validator::make($resquest->all() , [
            'vendor_id'=>'required|integer',
            'stor_id'=>'required',
            'mainBranch'=>'required|boolean',
            'Name'=>'required:unique:branchs',
            'country'=>'required',
            'city'=>'required',
            'address'=>'required',
            'postal_code'=>'required',
            'street'=>'required',
            'state'=>'required',
            'period'=>'min:0',
            'uponreciptcost'=>'min:0',
            'sun'=>'required_without_all:mon,tues,wend,thur,fri,sta',
            'mon'=>'required_without_all:sun,tues,wend,thur,fri,sta',
            'tues'=>'required_without_all:mon,sun,wend,thur,fri,sta',
            'wend'=>'required_without_all:mon,tues,sun,thur,fri,sta',
            'thur'=>'required_without_all:mon,tues,wend,sun,fri,sta',
            'fri'=>'required_without_all:mon,tues,wend,thur,sun,sta',
            'sta'=>'required_without_all:mon,tues,wend,thur,fri,sun',
        ],
        [
            
        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }else{
            $branch = branch::create([
                'vendor_id'=>$resquest->vendor_id,
                'stor_id'=>$resquest->stor_id,
                'mainBranch'=>$resquest->mainBranch,
                'Name'=>$resquest->Name,
                'country'=>$resquest->country,
                'city'=>$resquest->city,
                'address'=>$resquest->address,
                'postal_code'=>$resquest->postal_code,
                'street'=>$resquest->street,
                'state'=>$resquest->state,
                'period'=>$resquest->period,
                'uponreciptcost'=>$resquest->uponreciptcost,
                'sun'=>$resquest->sun,
                'mon'=>$resquest->mon,
                'tues'=>$resquest->tues,
                'wend'=>$resquest->wend,
                'thur'=>$resquest->thur,
                'fri'=>$resquest->fri,
                'sta'=>$resquest->sta,
            ]);
            if($branch){
                return $this->sendResponse($branch->toArray(), 'stor  created succesfully');
            }else{
                return $this->sendError("Error In Updating This Stor", [] , 500);
            }
        }
    }
}