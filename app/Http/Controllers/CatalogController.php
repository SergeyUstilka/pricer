<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Category $category,Request $request){
        if($_POST){
            $paginate_count= $request->input('count_product');
            $sort_by= $request->input('sort_by');
        }else{
            $paginate_count = 10;
            $sort_by = 'updated_at';
        }
        if($category->id){
            $products = Product::query()->where('cat_id',$category->id)->orderBy($sort_by,'desc')->paginate($paginate_count);
            $current_category = $category;
        }else{
            $products = Product::orderBy($sort_by,'desc')->paginate($paginate_count);
            $current_category = null;
        }

        return view('catalog.fasade',compact('products','current_category','request'));
    }

    public function product( Category $category, Product $product){
        $shop = Shop::query()->where('id',$product->shop_id)->first();
        return view('catalog.product', compact('product','category','shop'));
    }
}
