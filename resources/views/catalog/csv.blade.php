<?php

$fp = fopen(asset('/storage/csv/testcsv.csv'),'r');
while (($data = fgetcsv($fp, ",")) !== FALSE){
    $properties= array('name','img','description','cat_id','shop_id','price','unit');
    $product = new \App\Models\Product();
    $i=0;
    foreach ($properties as $property){
        $product->$property = $data[$i];
        $i++;
    }
    $product->save();
}
fclose($fp);
?>
@extends('layouts.app')
@section('content')
    <div>

    </div>
@endsection