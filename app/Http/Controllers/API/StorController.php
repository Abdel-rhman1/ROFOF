<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController;
use App\Models\stor;
use App\Models\vendor;
use App\Models\domain;
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
            'stor_link'=>'required',
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
            $stor = stor::create([
                'name'=>$resquest->name,
                'stor_type'=>$resquest->stor_type,
                'vendor_id'=>$vendor->id,
            ]);
            $domain = domain::create([
                'vendor_id'=>$vendor->id,
                'stor_id'=>$stor->id,
                'stor_url'=>$resquest->stor_link,
            ]);
            return $this->sendResponse($stor->toArray(), 'stor  created succesfully');
        }
    }

}
