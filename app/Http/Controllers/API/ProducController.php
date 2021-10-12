<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Produc;
use App\Models\stor;
use Validator;
use Auth;
class ProducController extends BaseController
{
    public function index($stor_id){
        $products = Produc::where([
            ['stor_id' , '=' , $stor_id]
        ])->get();
        return $this->sendResponse($products->toArray(), 'products read succesfully');
    }
    public function createProduct(Request $request){
        /*
            id' , 'stor_id' , 'branch_id' , 'categories' , 'type' , 'employeer_id' , 'price'
        ,'qty' , 'unlimitedOrNot' , 'alert_quantity' , 'remaining' , 'mainImage' ,'viedo',
        'moreThanImage' , 'is_variant' , 'is_diffPrice'
        */
        $validator = Validator::make($request->all() , [
            'stor_id'=>'required',
            //'branch_id'=>''// check if it is existed 
            'type'=>'required',
            'employeer_id'=>'required',
            'price'=>'required|numeric|min:0',
            'qty'=>'min:0',
            'unlimitedOrNot'=>'numeric|min:0|max:1',
            'alert_quantity'=>'numeric|min:0',
            'mainImage'=>'image|mimes:png,jpg,jpeg',
            'viedo'=>'url',
            'moreThanImage'=>'numeric|min:0|max:1',
            'is_variant'=>'numeric|min:0|max:1',
            'is_diffPrice'=>'numeric|min:0|max:1',
        ],[

        ]);

        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }else{
            $stor = stor::findOrFail($request->stor_id);
            if(!$stor){
                return $this->sendError('dosent exist id' ,[] , 404);
            }else{
                $data =  $request->except('toekn');
                if(isset($data->qty)){
                    $data->remaing = $data->qty;
                }
                //$product->employeer_id = 1;
                $product = Produc::create($data);
                
                return $this->sendResponse($product, 'brand created succesfully');
            }
        }
    }
    public function update(){
            

    }
    public function delete(){
        
    }
}
