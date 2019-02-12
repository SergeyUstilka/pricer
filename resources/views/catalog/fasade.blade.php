@extends('layouts.app')
@section('content')
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
                <div class="store-filter clearfix">
                    <form action="{{$_SERVER['REQUEST_URI']}}" method="post">
                        @csrf
                        @include('partials.fasade_top_filter')
                        <div class="clearfix"></div>
                        <div class="pull-right">
                            {{$products->render()}}
                        </div>
                    </form>

                </div>
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

                                    <img src="@if(strrpos($product->img,'sgone') === 0){{asset('/storage/img/'.$product->img)}}@else{{$product->img}}@endif" alt="">
                                </div>
                                <div class="product-body">
                                    <h3 class="product-price">{{$product->price}} за {{$product->unit}}</h3>
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
