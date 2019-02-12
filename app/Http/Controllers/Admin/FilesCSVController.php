<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\CSV;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilesCSVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shops = Shop::all();
        $csv_files = CSV::all();
        return view('admin.csv.csv',compact('shops', 'csv_files'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $shop = Shop::query()->where('id',$request->input('shop_id'))->first();
        $files = $request->csv_files;
        foreach ($files as $file){
            $name = ($shop->name).time().$file->getClientOriginalName();
            $file->move(storage_path('app/public/csv'),$name);
            $csv = new CSV();
            $csv->name = $name;
            $csv->shop_id = $shop->id;
            $csv->active = 0;
            $csv->description = $request->input('description');
            $csv->save();
        }
        $request->session()->flash('status','Каталог загружен');
        return redirect(route('admin.csv.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CSV  $cSV
     * @return \Illuminate\Http\Response
     */
    public function show(CSV $cSV)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CSV  $cSV
     * @return \Illuminate\Http\Response
     */
    public function edit(CSV $cSV)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CSV  $cSV
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CSV $cSV)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CSV  $cSV
     * @return \Illuminate\Http\Response
     */
    public function destroy(CSV $csv)
    {
        $file_path = app_path().'/../public/storage/csv/'.$csv->name;
        unlink($file_path);
        $csv->delete();
        return [];
    }


    public function activate(Request $request ){
        $file_path = app_path().'/../public/storage/csv/'.$request->input('csv');
        $fp = fopen($file_path,'r');
        while (($data = fgetcsv($fp, '10000', ';')) !== FALSE){
            $properties= array('name','img','description','cat_id','unit','price');
            $product = new Product();
            $i=0;
            foreach ($properties as $property){
                if($property == 'price'){
                    // Криво округляется поэтому разобъем строку с числом на массив

                    $price_array = explode(',',$data[$i]);
                    $price_final = (float)$price_array[0] + (float)($price_array[1]*0.01);
                    $product->$property = (0.6*$price_final);
                    break;
                }
                $product->$property = $data[$i];
                $i++;
            }
            $product->shop_id = $request->input('shop');
            $product->csv_id = $request->input('csv_id');

            $product->save();
        }
        fclose($fp);
        $csv = CSV::query()->where('id',$request->input('csv_id'))->first();
        $csv->active = 1;
        $csv->save();
        return [];
    }

    public function disactivate(Request $request ){
        $products = Product::query()->where('csv_id', $request->input('csv_id'))->get();
        foreach ($products as $product){
            $product->delete();
        }
        $csv = CSV::query()->where('id',$request->input('csv_id'))->first();
        $csv->active = 0;
        $csv->save();
    }
}
