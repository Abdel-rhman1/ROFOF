<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\stor;
use App\Models\vendor;
use App\Models\domain;
use App\Models\storActivities;
use App\Models\customerService;
use App\Models\socialMedia;
use App\Models\links;
use Validator;
class StorController extends BaseController
{
    public function index(){
        $stors = stor::all();
        return $this->sendResponse($stors->toArray(), 'stors read succesfully');
    }
    public function store(Request $resquest){
        $validator = Validator::make($resquest->all() , [
            'name'=>'required|min:4|unique:stors',
            'stor_link'=>'required|min:4|unique:stors',
            'stor_type'=>'required',
            'stor_admin'=>'required|min:4',
            'admin_phone'=>'required',
            'email'=>'required|unique:vendors2',
            'password'=>'required|min:4',
            'invitation_cubon'=>'nullable|url',
        ],[

        ]);

        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{
            $vendor = vendor::create([
                'email'=>$resquest->email,
                'name'=>$resquest->stor_admin,
                'phone'=>$resquest->admin_phone,
                'password'=>bcrypt($resquest->password),
            ]);
            //$data = $resquest->except('email' , 'stor_admin' , 'phone' , 'password');
            
            $stor = stor::create([
                'name'=>$resquest->name,
                'stor_type'=>$resquest->stor_type,
                'vendor_id'=>$vendor->id,
                'stor_link'=>$resquest->stor_link,
            ]);
            $domain = domain::create([
                'vendor_id'=>$vendor->id,
                'stor_id'=>$stor->id,
                'stor_url'=>$resquest->stor_link,
            ]);
            return $this->sendResponse($resquest->all(), 'stor  created succesfully');
        }
    }
    public function update(Request $resquest , $id){
        $validator = Validator::make($resquest->all() , [
            'name'=>'min:4|unique:stors,name,'.$id,
            'image'=>'mimes:jpeg,jpg,png',
            'browserIcon'=>'dimensions:min_width=32,min_height=32.max_width:64,max_height=64',
            'description'=>'min:6',
            
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{
            $stor1 = stor::find($id);
            if(!$stor1){
                return $this->sendError('dosent exist id' ,[] , 200);
            }
            $data = $resquest->except('token');
            $stor = stor::where('id' , '=' , $id)->update($data);
            return $this->sendResponse($stor1, 'stor updated succesfully');
        }
    }

    public function storActivity(Request $resquest){

        $validator = Validator::make($resquest->all() , [
            'stor_id'=>'required',
            'Activities'=>'required|min:2',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{            
            $stor = stor::find($id);
            if(!$stor){
                return $this->sendError('dosent exist id' ,[] , 200);
            }
            $data = $resquest->except('token');
            $stor = storActivities::updateOrCreate( ['stor_id'=> $id ] , [
                'Activities'=>$resquest->Activities,
                'stor_id'=>$id,
            ]);
            return $this->sendResponse($stor, 'stor updated succesfully');
        }
    }

    public function getStorActivity(int $stor_id){
        $stor = stor::find($stor_id);
        if(!$stor){
            return $this->sendError(' This Stor dosent exist' ,[] , 400);
        }
        $storActivities = storActivities::where('stor_id' , '=' , $stor_id)->get();
        if(!$storActivities){
            return $this->sendError('Errro In Getting This Stor Ativities' ,[] , 500);
        }else{
            return $this->sendResponse($storActivities, 'stor Activities Reads succesfully');
        }
    }

    public function customerServicesStor(Request $resquest){
        $validator = Validator::make($resquest->all() , [
            //'sun'=>'required_without_all:mon,tues,wend,thur,fri,sta',
            'stor_id'=>'required',
            'phone'=>'required_without_all:wattsap',
            'wattsap'=>'required_without_all:phone',
            'mobile'=>'regex:/(01)[0-9]{9}',
            'telegram'=>'url',
            'email'=>'email|unique:customerServicesStor',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{            
            $stor = stor::find($resquest->stor_id);
            if(!$stor){
                return $this->sendError('dosent exist id' ,[] , 200);
            }
            $data = $resquest->except('token');
            $stor1 = customerService::updateOrCreate(['stor_id'=> $resquest->stor_id],
                $data
            );
            return $this->sendResponse($stor1, 'stor updated succesfully');
        }
    }

    public function getCustomerServicesStor($stor_id){

    }

    public function socialMedia(Request $resquest , $id){
        //'id','stor_id', 'instgram','twitter','facebook','youtube','snapchat','tiktok'
        $validator = Validator::make($resquest->all() , [
            //'sun'=>'required_without_all:mon,tues,wend,thur,fri,sta',
            'stor_id'=>'required',
            'instgram'=>'url',
            'twitter'=>'url',
            'facebook'=>'url',
            'youtube'=>'url',
            'snapchat'=>'url',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{            
            $stor = stor::find($id);
            if(!$stor){
                return $this->sendError('dosent exist id' ,[] , 200);
            }
            $data = $resquest->except('toekn');
            $stor = socialMedia::updateOrCreate( ['stor_id'=> $id ] , 
                $data
            );
            return $this->sendResponse($stor, 'stor updated succesfully');
        }
    }
    public function links(Request $resquest , $id){
        $validator = Validator::make($resquest->all() , [
            //'stor_id' , 'link' , 'iosApplication' , 'androidApplication' , 'id'
            'stor_id'=>'required',
            'link'=>'url',
            'iosApplication'=>'url',
            'androidApplication'=>'url',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{            
            $stor = stor::find($id);
            if(!$stor){
                return $this->sendError('dosent exist id' ,[] , 200);
            }
            $data = $resquest->except('toekn');
            $stor = links::updateOrCreate( ['stor_id'=> $id ] , 
                $data
            );
            return $this->sendResponse($stor, 'stor updated succesfully');
        }
    }   
}