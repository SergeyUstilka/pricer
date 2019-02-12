@extends('layouts.app')
@section('content')
    <!-- BREADCRUMB -->
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{route('main_page')}}">Главная</a></li>
                <li><a href="{{route('catalog')}}">Каталог</a></li>
                <li><a href="{{route('catalog',['category'=>$category])}}">{{$category->name}}</a></li>
                <li class="active">{{$product->name}}</li>
            </ul>
        </div>
    </div>
    <!-- /BREADCRUMB -->

    <!-- section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!--  Product Details -->
                <div class="product product-details clearfix">
                    <div class="col-md-6">
                        <div id="product-main-view">
                            <div class="product-view">
                                <img src="{{$product->img}}" alt="">
                            </div>
                        </div>
                        <div id="product-view">
                            <div class="product-view">
                                <img src="{{$product->img}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-body">
                            <h2 class="product-name">{{$product->name}}</h2>
                            <h3 class="product-price">{{$product->price}}{{$product->unit}} </h3>

                            <p><strong>Магазин:</strong> {{$shop->name}}</p>
                            <p>{{$product->description}}</p>
                            <div class="product-btns">
                                <div class="qty-input">
                                    <span class="text-uppercase">QTY: </span>
                                    <input class="input" type="number">
                                </div>
                                <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                <div class="pull-right">
                                    <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                    <button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                    <button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Product Details -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /section -->
@endsection