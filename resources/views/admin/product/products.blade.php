@extends('layouts.admin')
@section('content')
    <style>
        .form-group{
            display: inline-block;
        }
        .filter-list{
            margin: 30px 0;
        }
    </style>
    <div class="row">
        <div class="col-md-9 filter-list" >
            <form action="{{$_SERVER['REQUEST_URI']}}">
                @csrf
                <div class="form-group">
                    <label>Сортировать</label>
                    <select class="form-control" name="order">
                        <option value="price">По цене</option>
                        <option value="updated_at">По новизне</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Категории</label>
                    <select class="form-control" name="category">
                        <option value="">Любая</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}"  @if($category_order == $category->id) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Магазины</label>
                    <select class="form-control" name="shop">
                        <option value="">Любой</option>
                        @foreach($shops as $shop)
                            <option value="{{$shop->id}}" @if($shop_order == $shop->id) selected @endif>{{$shop->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-md btn-success">Сортировать</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>id</th>
                        <th>Изображение</th>
                        <th>Название</th>
                        <th>Slug</th>
                        <th>Описание</th>
                        <th>Категория</th>
                        <th>Магазин</th>
                        <th>Еденицы измерения</th>
                        <th>Цена</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><img src="{{asset('/storage/img/'.$product->img)}}" alt="" width="100px;"></td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->slug}}</td>
                            <td>{{$product->desription}}</td>
                            <td>
                                @foreach($categories as $category)
                                    @if($category->id == $product->cat_id)
                                        {{$category->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($shops as $shop)
                                    @if($shop->id == $product->shop_id)
                                        {{$shop->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$product->unit}}</td>
                            <td>{{$product->price}}</td>
                            <td>
                                <button type="button" class="btn btn-md btn-primary">Primary</button>
                                <br>
                                <br>
                                <button type="button" class="btn btn-md btn-danger">Danger</button>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
