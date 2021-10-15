<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\stor;
use Illuminate\Validation\Rule;
use Validator;
class brandController extends BaseController
{
    public function getStorbrands($stor_id){
        $brands = Brand::where([
            ['stor_id' , '=' , $stor_id]
        ])->get();
        return $this->sendResponse($brands->toArray(), 'brands read succesfully');
    }
    public function createBrands(Request $request){
        $validator = Validator::make($request->all() , [
            'stor_id'=>'required',
            'details'=>'min:10',
            'name'=>['required','min:2' , Rule::unique('brands')->where(function($query) use ($request) {
                $query->where('stor_id', '=', $request->stor_id);
            }),
            ],
            'logo'=>'required',
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
                return $this->sendError('Your Stor dosent exist id' ,[]);
            }
            $data = $request->except('token');            
            $brand = Brand::create($data);
            return $this->sendResponse($brand, 'brand created succesfully');
        }
    }
    public function update(Request $request , int $b_id){
        $validator = Validator::make($request->all() , [
            'stor_id'=>'required',
            'details'=>'min:10',
            'name'=>'required',
            
            'logo'=>'required',
            'pagetitle'=>'min:4',
            'pageDescription'=>'min:8',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{
            $stor = stor::find($request->stor_id);
            $brand = Brand::find($b_id);
            if(!$stor  || !$brand){
                return $this->sendError('the Stor or Brand dosent exist id' ,[] , 404);
            }
            $data = $request->except('token');
            $brand = Brand::where('id' , '=' , $request->b_id)->update($data);
            return $this->sendResponse($data, 'brand updated succesfully');
        }
    }
    public function delete($id){
        $brand = Brand::find($id);
        if(!$brand){
            return $this->sendError('dosent exist id' ,[] , 200);
        }else{
            $brand = Brand::where('id' , '=' , $id)->delete();
            if($brand){
                return $this->sendResponse($brand, 'brand deleted succesfully');
            }
        }
    }
}