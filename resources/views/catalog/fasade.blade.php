@extends('layouts.app')
@section('content')
<!-- BREADCRUMB -->
<div id="breadcrumb">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{route('main_page')}}">Главная</a></li>
            <li><a href="{{route('catalog')}}">Каталог</a></li>
            @if($current_category)
            <li>{{$current_category->name}}</li>
                @endif
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
            <!-- ASIDE -->
            @include('partials.asside_catalog')
            <!-- /ASIDE -->

            <!-- MAIN -->
            <div id="main" class="col-md-9">
                <!-- store top filter -->
                <div class="store-filter clearfix">
                    <form action="{{$_SERVER['REQUEST_URI']}}" method="post">
                        @csrf
                        <div class="pull-left">

                            <div class="sort-filter">
                                <span class="text-uppercase">Сортировать по:</span>
                                <select class="input" name="sort_by">
                                    <option value="updated_at" @if($request->input('sort_by')== 'updated_at') selected @endif>Новизне</option>
                                    <option value="price" @if($request->input('sort_by')== 'price') selected @endif>Цене</option>
                                </select>
                                <button type="submit" class="main-btn icon-btn"><i class="fa fa-arrow-down"></i></button>
                            </div>
                        </div>
                        <div class="pull-right">
                            <div class="page-filter">
                                <span class="text-uppercase">Товаров на странице:</span>
                                <select class="input" name="count_product">
                                    <option value="10" @if($request->input('count_product')== '10') selected @endif>10</option>
                                    <option value="20"@if($request->input('count_product')== '20') selected @endif>20</option>
                                    <option value="30"@if($request->input('count_product')== '30') selected @endif>30</option>
                                </select>
                                <button class="main-btn icon-btn" type="submit"><i class="fa fa-arrow-down"></i></button>
                            </div>
                             {{$products->render()}}
                        </div>
                    </form>

                </div>
                <!-- /store top filter -->

                <!-- STORE -->
                <div id="store">
                    <!-- row -->
                    <div class="row">
                        @foreach($products as $product)
                        <!-- Product Single -->
                        <div class="col-md-4 col-sm-6 col-xs-6">
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <a href="{{route('product',['product'=>$product, 'category'=>\App\Models\Category::query()->where('id',$product->cat_id)->first()])}}" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Описание</a>

                                    <img src="
                                        @if(strrpos($product->img,'sgone') === 0)
                                            {{asset('/storage/img/'.$product->img)}}
                                        @else
                                            {{$product->img}}
                                        @endif

                                             " alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">{{$product->price}}</h3>
                                    <h2 class="product-name">
                                        <a href="{{route('product',['product'=>$product, 'category'=>\App\Models\Category::query()->where('id',$product->cat_id)->first()])}}">
                                            {{$product->name}}
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <!-- /Product Single -->
                        <div class="clearfix visible-sm visible-xs"></div>
                        @endforeach
                    </div>
                    <!-- /row -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /MAIN -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /section -->

@endsection
