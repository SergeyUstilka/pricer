<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Category $category,Request $request){
        $catalog_filter = $request->session()->get('catalog_filter');
        if(!$request->session()->get('catalog_filter')){
            $catalog_filter['count_product'] = 10;
            $catalog_filter['sort_by'] = 'updated_at';
            $catalog_filter['shop'] = 'all';
            session('catalog_filter',$catalog_filter);
        };
        if($_POST){
            $catalog_filter['count_product'] = $request->input('count_product');;
            $catalog_filter['sort_by'] = $request->input('sort_by');
            $catalog_filter['shop'] = $request->input('sort_shop');
            session(['catalog_filter'=>$catalog_filter]);
        }

        if($category->id){
            $products = Product::query()->where('cat_id',$category->id)->orderBy($catalog_filter['sort_by'],'desc')
                ->paginate($catalog_filter['count_product']);
            $current_category = $category;
            if(isset(explode('?',$_SERVER['REQUEST_URI'])[1])){
                $pagination_page_parametr = explode('?',$_SERVER['REQUEST_URI'])[1];  ///  Возвращает что то типа "page=2"
                if(explode('=',$pagination_page_parametr)[0] == 'page'){
                    if(count($products->items())  === 0){
                        return redirect('/catalog/'.$category->slug.'/');
                    }
                }
            }

        }else{
            $products = Product::orderBy($catalog_filter['sort_by'],'desc')
                ->paginate($catalog_filter['count_product']);
            $current_category = null;

        }

        return view('catalog.fasade',compact('products','current_category','request'));
    }

    public function product( Category $category, Product $product){
        $shop = Shop::query()->where('id',$product->shop_id)->first();
        return view('catalog.product', compact('product','category','shop'));
    }


    public function csv(){
        return view('catalog.csv');
    }
}
