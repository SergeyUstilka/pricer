<?php

namespace App\Http\Controllers\Admin;

use App\Models\CSV;
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
        return view('admin.csv.csv',compact('shops'));
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
    public function destroy(CSV $cSV)
    {
        //
    }
}
