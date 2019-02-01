<?php

namespace App\Http\Controllers\Admin;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {

        return view('admin.product.photo', compact('product'));
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
    public function store(Request $request, Product $product)
    {
        if(isset($request->images)){
            $files = $request->images;
            foreach ($files as $file) {
                $name = 'sgone_'.time().$file->getClientOriginalName();
                $file->move(storage_path('app/public/img'),$name);
                $photo = new Photo();
                $photo->name = $name;
                $photo->product_id = $product->id;
                $photo->save();
            }
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $photos = $product->photos;
        foreach ($photos as $photo){
            if($photo->id == intval($request->main_photo)){
                $photo->main_photo = 1;
                $product->img = $photo->name;
                $product->save();

            }else{
                $photo->main_photo = 0;

            }
            $photo->save();
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Photo $photo)
    {
        $photo->delete();
        return [];
    }
}
