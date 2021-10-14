<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\stor;
use Validator;
use Illuminate\Validation\Rule;
class CategoriesController extends BaseController
{
    // 'id' , 'stor_id' , 'parent' , 'name' , 'visiable',
    public function index($stor_id){
        $Categories = Categories::where([
            ['stor_id' , '=' , $stor_id] ,['visiable' , '=' , 1],
        ])->get();
        return $this->sendResponse($Categories->toArray(), 'Categories read succesfully');
    }

    public function createCategories(Request $resquest){
        // $str = $resquest->stor_id;
        $validator = Validator::make($resquest->all() , [
            'stor_id'=>'required',
            'parent'=>'digits_between:0,2',
            'name'=>['required','min:2' , Rule::unique('categories')->where(function($query) use ($resquest) {
                $query->where('stor_id', '=', $resquest->stor_id);
            }),
        ],
            'visiable'=>'digits_between:0,1',
        ],[
        ]);
        
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }

        else{
            $stor = stor::find($resquest->stor_id);
            if(!$stor){
                return $this->sendError('stor dosent exist id' ,[] , 404);
            }
            $data = $resquest->except('toekn');
            $cats = Categories::create($data);
            return $this->sendResponse($cats, 'stor updated succesfully');
        }
    }

    public function updateCat(Request $resquest , $cat_id){
        $validator = Validator::make($resquest->all() , [
            'name'=>'min:2',
            'stor_id'=>'required',
            'parent'=>'digits_between:0,2',
            'hidden_Products'=>'boolean',
            'visiable'=>'digits_between:0,1',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        else{
            $cat = Categories::find($cat_id);
            $stor = stor::find($resquest->stor_id);

            if(!$cat || !$stor){
                return $this->sendError('category or stor dosent exist' ,[] , 400);
            }
            $data = $resquest->except('token');
            $cat = Categories::where('id' , '=' , $cat_id)->update($data);
            $cat = Categories::find($cat_id);
            return $this->sendResponse($cat, 'Categories updated succesfully');
        }
    }
    public function deleteCat($cat_id){
        $cat = Categories::find($cat_id);
        if(!$cat){
            return $this->sendError('dosent exist id' ,[] , 200);
        }else{
            $cat = Categories::where('id' , '=' , $cat_id)->orWhere('parent' , '=' , $cat_id)->delete();
            if($cat){
                return $this->sendResponse($cat, 'Categories deleted succesfully');
            }
        }
    }
}
