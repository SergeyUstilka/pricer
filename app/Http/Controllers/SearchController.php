<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request){
        if(count($request->input('patern'))>0){
            $pattern ="%".$request->input('patern')."%";
            $category = "%".$request->input('category')."%";
            $products=  Product::query()->where('cat_id','like',$category)->where('name','like',$pattern)->get();
            $res = [];
            if(count($products)){
                foreach ($products as $product){
                    $category_slug = Category::query()->where('id',$product->cat_id)->first()->slug;
                    $res[]=array($product,$category_slug);
                }
            }
        }else{
            $res = [];
        }
        return json_encode($res);
    }

    public function find(Request $request){
        if(!$request->input('data')){
            $products = null;
        }else{
            $name = "%".$request->input('data')."%";
            $category = $request->input('category_id');

            if($category){
                $products = Product::query()->where('cat_id',$category)->where('name','like',$name)->get();
            }else{
                $products = Product::query()->where('name','like',$name)->get();
            }
            $categories = Category::all();
        }


        return view('catalog.search_results',compact('products','categories'));
    }
}
