<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Produc;
use App\Models\stor;
use App\Models\Categories;
use App\Models\Brand;
use App\Models\ProductCat;
use App\Models\ProductBrand;
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
            'name'=>'required|min:3',
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
            $stor = stor::find($request->stor_id);
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

    public function addCats(Request $request){
        $validator = Validator::make($request->all() , [
            'p_id'=>'required|numeric|min:0',
            'cat_id'=>'required|numeric|min:0',
            'stor_id'=>'required|numeric|min:0',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        $cat = Categories::find($request->cat_id);
        $stor = stor::find($request->stor_id);
        $prod = Produc::find($request->p_id);
        if(!$stor || !$cat || !$prod){
            return $this->sendError('this stor_id or brand_id dosent exist', []);
        }
        $product = ProductCat::where([
            ['stor_id' , '=' , $request->stor_id],
            ['cat_id' , '='  , $request->cat_id],
            ['product_id' , '=' , $request->p_id]
        ])->get();
        // return count($product);
        if(count($product) > 0){
            return $this->sendError('this Product Oready In This Category', []);
        }
        $product = ProductCat::create([
            'cat_id'=>$request->cat_id,
            'product_id'=>$request->p_id,
            'stor_id'=>$request->stor_id,
        ]);
        return $this->sendResponse($product->toArray(), 'Cat add To product succesfully');
        
    }

    public function addBrand(Request $request){
        //$p_id , $b_id
        $validator = Validator::make($request->all() , [
            'p_id'=>'required|numeric|min:0',
            'b_id'=>'required|numeric|min:0',
            'stor_id'=>'required|numeric|min:0',
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());
        }
        $Brands = Brand::find($request->b_id);
        $stor = stor::find($request->stor_id);
        $prod = Produc::find($request->p_id);
        if(!$stor || !$Brands || !$prod){
            return $this->sendError('this stor_id or brand_id dosent exist', []);
        }
        $product =ProductBrand::where([
            ['stor_id' , '=' , $request->stor_id],
            ['b_id' , '='  , $request->b_id],
            ['p_id' , '=' , $request->p_id]
        ])->get();
        if(count($product) > 0){
            return $this->sendError('this Product Oready In This Brand', []);
        }
        $product = ProductBrand::create([
            'p_id'=>$request->p_id,
            'b_id'=>$request->b_id,
            'stor_id'=>$request->stor_id,
        ]);
        return $this->sendResponse($product->toArray(), 'Brand add To product succesfully');
        
    }
    public function update(Request $request , $P_id){
            $validator = Validator::make($request->all()  , [
            //'branch_id'=>''// check if it is existed 
            'type'=>'numeric|min:0|max:4',
            'price'=>'numeric|min:0',
            'qty'=>'min:0',
            'unlimitedOrNot'=>'numeric|min:0|max:1',
            'alert_quantity'=>'numeric|min:0',
            'mainImage'=>'image|mimes:png,jpg,jpeg',
            'viedo'=>'url',
            'moreThanImage'=>'numeric|min:0|max:1',
            'is_variant'=>'numeric|min:0|max:1',
            'is_diffPrice'=>'numeric|min:0|max:1',
            ] ,[

            ]);
            if($validator->fails()){
                return $this->sendError('error validation', $validator->errors());
            }
            $Produc = Produc::find($P_id);
            if(!$Produc){
                return $this->sendError('This Product dosent exist id' ,[] , 404);
            }else{
                $data =  $request->except('token');
                if(isset($data->qty)){
                    $data->remaing = $data->qty;
                }
                $product = Produc::where('id' , '=' , $P_id)->update($data);
                $product = Produc::where('id' , '=' , $P_id)->get();
                return $this->sendResponse($product, 'Product Updated succesfully');
            }
    }

    public function delete($P_id){
        $product = Produc::find($P_id);
        if(!$product){
            return $this->sendError('dosent exist id' ,[] , 404);
        }else{
            $Produc = Produc::where('id' , '=' , $P_id)->delete();
            if($Produc){
                return $this->sendResponse($Produc, 'Product deleted succesfully');
            }
        }
    }

    public function getByCat($stor_id , $cat_id){
        $stor = stor::find($stor_id);
        $Categories = Categories::find($cat_id);
        if(!$stor || !$Categories){
            return $this->sendError('This Prosuct dosent exist or stor dosent exist or not in this stor' ,[] , 404);
        }else{
            $products = Produc::select(
                'products.*'
            )->join('product_cats' , 'product_cats.product_id' ,'=', 'products.id')->where(
                'product_cats.cat_id' , '=' , $cat_id
            )->where('product_cats.stor_id' , '=' , $stor_id)->
            get();
            if($products){
                return $this->sendResponse($products, 'Products Belong This Categories');
            }
        }
    }
    public function getByBrand($stor_id , $brand_id){
        $stor = stor::find($stor_id);
        $Brands = Brand::find($brand_id);
        if(!$stor || !$Brands){
            return $this->sendError('This Prosuct dosent exist or stor dosent exist or not in this stor' ,[] , 404);
        }else{
            $products = Produc::select(
                'products.*'
            )->join('product_brands' , 'product_brands.p_id' ,'=', 'products.id')->where(
                'product_brands.b_id' , '=' , $brand_id
            )->where('product_brands.stor_id' , '=' , $stor_id)->
            get();
            if($products){
                return $this->sendResponse($products, 'Products Belong This Brand');
            }
        }
    }
    public function deleteAllProducs($stor_id){
        $stor = stor::find($stor_id);
        if(!$stor){
            return $this->sendError('this stor dosent exist' ,[] , 404);
        }else{
            $products = Produc::where('stor' , '=' , $stor_id)->delete();
            if($products){
                return $this->sendResponse($products, 'Products Belong This stor are deleted');
            }
        }
    }

    public function POSSystem($stor_id){
        $stor = stor::find($stor_id);
        if(!$stor){
            return $this->sendError('this stor dosent exist' ,[] , 404);
        }else{
            $products = Produc::where('stor_id' , '=' , $stor_id);
            if($products){
                return $this->sendResponse($products, 'Products are read succesfully');
            }
        }
    }
    
    public function ProductSearch(Request $request){
        $validator = Validator::make($request->all() , [
            'stor_id'=>'required|numeric|min:0',
            'word'=>'required|min:0'
        ],[

        ]);
        if($validator->fails()){
            return $this->sendError('error validation', $validator->errors());        
        }
        $stor = stor::find($request->stor_id);
        if(!$stor){
            return $this->sendError('dosent exist id' ,[] , 404);
        }
        $first = Produc::select("products.*")->where('name' , 'like' , '%'.$request->word . '%')->
        orwhere('details' , 'like' , '%'.$request->word . '%')->where('stor_id',
        '=' ,$request->stor_id);

        $products = Produc::select('products.*')
        ->join('product_cats' , 'product_cats.product_id' ,'=', 'products.id')->join("categories"
        ,'categories.id' , 'product_cats.cat_id')->where('categories.name' , 'like' ,
        '%'.$request->word . '%')->union($first)
        ->get();
        
        return $this->sendResponse($products, 'Products are read succesfully');
    }
}