@extends('layouts.app')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if(count($products))
                        <h2>Найдено  товаров: {{count($products)}}</h2>
                    @else
                        <h2>Ничего не найдено, попробуйте поискать в <a href="{{route('catalog')}}" style="text-decoration: underline">каталоге</a></h2>
                    @endif
                </div>
            </div>
            <div class="row">
            @foreach($products as $product)
                <!-- Product Single -->
                    <input id="signup-token" name="_token" type="hidden" value="{{csrf_token()}}">
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="product product-single">
                            <div class="product-thumb">
                                <a href="{{route('product',['product'=>$product, 'category'=>\App\Models\Category::query()->where('id',$product->cat_id)->first()])}}" class="main-btn quick-view"><i class="fa fa-search-plus"></i> Описание</a>
                                <img src="{{asset('/storage/img/'.$product->img)}}" alt="">
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
        </div>
    </div>

@endsection