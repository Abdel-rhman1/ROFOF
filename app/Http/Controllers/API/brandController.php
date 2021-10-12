<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\stor;
use Validator;
class brandController extends BaseController
{
    public function getStorbrands($stor_id){
        $brands = Brand::where([
            ['stor_id' , '=' , $stor_id]
        ])->get();
        return $this->sendResponse($brands->toArray(), 'brands read succesfully');
    }
    public function createBrands(Request $request , $stor_id){
        //'id' , 'stor_id' , 'details' , 'brandName' , 'banarIamge' , 'brandLogo' ,'pagetitle'
        
        $validator = Validator::make($request->all() , [
            'stor_id'=>'required',
            'details'=>'min:10',
            'brandName'=>'required',
            'brandLogo'=>'required',
            'pagetitle'=>'min:4',
            'pageDescription'=>'min:8',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{
            $stor = stor::find($stor_id);
            if(!$stor){
                return $this->sendError('dosent exist id' ,[] , 404);
            }
            $data = $request->except('toekn');
            
            $brand = Brand::create($data);
            return $this->sendResponse($brand, 'brand created succesfully');
        }
    }
    public function update(Request $request , $cat_id){
        $validator = Validator::make($request->all() , [
            'stor_id'=>'required',
            'details'=>'min:10',
            'brandName'=>'required',
            'brandLogo'=>'required',
            'pagetitle'=>'min:4',
            'pageDescription'=>'min:8',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{
            $stor = stor::find($request->stor_id);
            if(!$stor){
                return $this->sendError(' this Brand dosent exist id' ,[] , 404);
            }
            $data = $request->except('toekn');
            $brand = Brand::where('id' , '=' , $cat_id)->update($data);
            return $this->sendResponse($data, 'brand updated succesfully');
        }
    }
    public function delete($id){
        $cat = Brand::find($id);
        if(!$cat){
            return $this->sendError('dosent exist id' ,[] , 200);
        }else{
            $cat = Brand::where('id' , '=' , $id)->delete();
            if($cat){
                return $this->sendResponse($cat, 'Categories deleted succesfully');
            }
        }
    }
}