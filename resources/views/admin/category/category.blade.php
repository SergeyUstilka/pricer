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
        <ol class="breadcrumb">
            <li><a href="{{route('admin.')}}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Товары</li>
        </ol>
    </div><!--/.row-->
    @if ($message = Session::get('status'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>id</th>
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
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>{{$category->desription}}</td>
                            <td>
                                @foreach($categories as $category)
                                    @if($category->id == $category->cat_id)
                                        {{$category->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach($shops as $shop)
                                    @if($shop->id == $category->shop_id)
                                        {{$shop->name}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$category->unit}}</td>
                            <td>{{$category->price}}</td>
                            <td>
                                <a href="{{route('admin.product.edit',['product'=>$category])}}" type="button" class="btn btn-md btn-primary">Редактировать</a>
                                <br>
                                <br>
                                <a href="{{route('admin.photo.index', ['product'=>$category])}}" class="btn btn-md btn-default">Фотографии</a>
                                <br>
                                <br>
                                <button type="button" class="btn btn-md btn-danger delete-data" data-url="{{route('admin.product.destroy',['product'=>$category])}}">Удалить</button>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
