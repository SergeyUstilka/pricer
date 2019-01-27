<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Category $category){

        if($category->id){
            $products = Product::query()->where('cat_id',$category->id)->paginate(6);
            $current_category = $category;
        }else{
            $products = Product::paginate(6);
            $current_category = null;
        }

        return view('catalog.fasade',compact('products','current_category'));
    }

    public function product( Category $category, Product $product){
        return view('catalog.product', compact('product','category'));
    }
}
